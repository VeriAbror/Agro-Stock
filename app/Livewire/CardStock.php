<?php

namespace App\Livewire;

use App\Models\CardStock as ModelsCardStock;
use App\Models\CardStockDetail;
use App\Models\MasterStock;
use App\Models\MutasiStock;
use Illuminate\Support\Carbon;
use Livewire\Component;

class CardStock extends Component
{
    public $periode_awal;
    public $periode_akhir;
    public $kode_barang = '';
    public $nama_barang = '';
    public $card_stocks = [];
    public $detail_stock = [];
    public $selectedKodeBarang = null;
    public $showModal = false;
    public $kodeBarangMutasi = [];

    protected $queryString = [
        'periode_awal',
        'periode_akhir',
        'kode_barang',
        'nama_barang',
    ];

    public function mount()
    {
        $this->periode_awal = $this->periode_awal ?? now()->subMonth()->format('Y-m-d');
        $this->periode_akhir = $this->periode_akhir ?? now()->format('Y-m-d');
        $this->kodeBarangMutasi = \App\Models\MutasiStock::query()
            ->select('kode_barang')
            ->distinct()
            ->orderBy('kode_barang')
            ->pluck('kode_barang')
            ->toArray();
        $this->loadData();
    }

    public function updatedKodeBarang($value)
    {
        // Cari nama_barang dari mutasi_stock (atau master_stock jika ingin lebih lengkap)
        $mutasi = \App\Models\MutasiStock::where('kode_barang', $value)->orderByDesc('tanggal')->first();
        if ($mutasi) {
            $this->nama_barang = $mutasi->nama_barang;
        } else {
            $this->nama_barang = '';
        }
    }

    // Saat filter berubah, muat ulang data header (tanpa mereset detail/modal)
    public function updated($propertyName)
    {
        if (in_array($propertyName, ['periode_awal', 'periode_akhir', 'kode_barang', 'nama_barang'])) {
            $this->loadData();
            // Tutup detail/modal jika filter berubah
            $this->resetDetail();
        }
    }

    // Ambil data snapshot rekap (header) yang sesuai dengan periode tertentu
    public function loadData()
    {
        $query = ModelsCardStock::query()
            ->where('periode_awal', $this->periode_awal)
            ->where('periode_akhir', $this->periode_akhir);

        if (!empty($this->kode_barang)) {
            $query->where('kode_barang', 'like', '%' . $this->kode_barang . '%');
        }
        if (!empty($this->nama_barang)) {
            $query->where('nama_barang', 'like', '%' . $this->nama_barang . '%');
        }

        $this->card_stocks = $query->orderBy('kode_barang')->get();
    }

    public function resetDetail()
    {
        $this->showModal = false;
        $this->selectedKodeBarang = null;
        $this->detail_stock = [];
    }

    // Proses snapshot rekap dan detail dari MasterStock + MutasiStock
    public function generateCardStock()
    {
        
        $periode_awal = Carbon::parse($this->periode_awal)->format('Y-m-d');
        $periode_akhir = Carbon::parse($this->periode_akhir)->format('Y-m-d');

        $query = MasterStock::query();
        if (!empty($this->kode_barang)) {
            $query->where('kode_barang', 'like', '%' . $this->kode_barang . '%');
        }
        if (!empty($this->nama_barang)) {
            $query->where('nama_barang', 'like', '%' . $this->nama_barang . '%');
        }
        $barangs = $query->get();

        foreach ($barangs as $barang) {
            $kode = $barang->kode_barang;
            $nama = $barang->nama_barang;
            $satuan = $barang->satuan;
            // qty_awal dari master_stock
            $stok_awal = $barang->qty_awal ?? 0;

            // Hitung stok awal periode dari mutasi sebelum periode
            $mutasiSebelum = MutasiStock::where('kode_barang', $kode)
                ->where('tanggal', '<', $periode_awal)
                ->get();
            foreach ($mutasiSebelum as $mut) {
                if (in_array($mut->tipe_transaksi, ['IN', 'RETURN'])) {
                    $stok_awal += $mut->jumlah_qty;
                } elseif ($mut->tipe_transaksi === 'OUT') {
                    $stok_awal -= $mut->jumlah_qty;
                }
            }

            // Mutasi dalam periode
            $mutasiDalam = MutasiStock::where('kode_barang', $kode)
                ->whereBetween('tanggal', [$periode_awal, $periode_akhir])
                ->orderBy('tanggal')
                ->get();

            $total_in     = $mutasiDalam->where('tipe_transaksi', 'IN')->sum('jumlah_qty');
            $total_out    = $mutasiDalam->where('tipe_transaksi', 'OUT')->sum('jumlah_qty');
            $total_return = $mutasiDalam->where('tipe_transaksi', 'RETURN')->sum('jumlah_qty');
            $stok_akhir   = $stok_awal + $total_in + $total_return - $total_out;

            // Simpan/update header snapshot
            ModelsCardStock::updateOrCreate(
                [
                    'kode_barang'   => $kode,
                    'periode_awal'  => $periode_awal,
                    'periode_akhir' => $periode_akhir,
                ],
                [
                    'nama_barang'           => $nama,
                    'satuan'                => $satuan,
                    'qty_periode_awal'      => $stok_awal,
                    'qty_periode_akhir'     => $stok_akhir,
                    'total_barang_in'       => $total_in,
                    'total_barang_out'      => $total_out,
                    'total_barang_return'   => $total_return,
                    'total_pemakaian'       => $total_out,
                ]
            );

            // Hapus detail snapshot lama
            CardStockDetail::where('kode_barang', $kode)
                ->whereBetween('tanggal', [$periode_awal, $periode_akhir])
                ->delete();

            // Insert detail snapshot baru (dengan running saldo)
            $runningStok = $stok_awal;
            foreach ($mutasiDalam as $mutasi) {
                if (in_array($mutasi->tipe_transaksi, ['IN', 'RETURN'])) {
                    $runningStok += $mutasi->jumlah_qty;
                } elseif ($mutasi->tipe_transaksi === 'OUT') {
                    $runningStok -= $mutasi->jumlah_qty;
                }
                CardStockDetail::create([
                    'kode_barang'     => $kode,
                    'nama_barang'     => $nama,
                    'tanggal'         => $mutasi->tanggal,
                    'f'               => $mutasi->f ?? null,
                    'satuan'          => $satuan,
                    'jumlah_qty'      => $mutasi->jumlah_qty,
                    'tipe_transaksi'  => $mutasi->tipe_transaksi,
                    'no_surat'        => $mutasi->no_surat,
                    'jenis_surat'     => $mutasi->jenis_surat,
                    'status_surat'    => $mutasi->status_surat,
                    'supplier'        => $mutasi->supplier,
                    'keterangan'      => $mutasi->keterangan,
                    'qty_akhir'       => $runningStok,
                ]);
            }
        }

        $this->loadData();
        $this->resetDetail();
        session()->flash('message', 'Card Stock & detail berhasil digenerate.');
    }

    // Tampilkan detail transaksi untuk barang tertentu (modal)
    public function lihatDetail($kode_barang)
    {
        $this->selectedKodeBarang = $kode_barang;
        $this->detail_stock = CardStockDetail::where('kode_barang', $kode_barang)
            ->whereBetween('tanggal', [$this->periode_awal, $this->periode_akhir])
            ->orderBy('tanggal', 'asc')
            ->get()
            ->toArray();
        $this->showModal = true;
    }

    public function closeModal()
    {
        $this->resetDetail();
    }

    public function render()
    {
        return view('livewire.card-stock');
    }
}