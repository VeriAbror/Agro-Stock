<?php

namespace App\Livewire;

use App\Models\MasterStock;
use App\Models\MutasiStock as ModelsMutasiStock;
use Livewire\Component;
use Livewire\WithPagination;

class MutasiStock extends Component
{
    use WithPagination;
    protected $paginationTheme = 'tailwind';
    protected $updatesQueryString = ['page'];


    public $kode_barang, $nama_barang, $tanggal, $f, $satuan, $jumlah_qty,
           $tipe_transaksi, $no_surat, $jenis_surat, $status_surat,
           $supplier, $keterangan, $qty_akhir, $mutasi_id;

    public $editMode = false;
    public $search = '';

    public function updatedKodeBarang($value)
    {
        $barang = MasterStock::where('kode_barang', $value)->first();
        if ($barang) {
            $this->nama_barang = $barang->nama_barang;
        } else {
            $this->nama_barang = null;
        }
    }


    public function resetInput()
    {
        $this->reset([
            'kode_barang', 'tanggal', 'f', 'satuan', 'jumlah_qty',
            'tipe_transaksi', 'no_surat', 'jenis_surat', 'status_surat',
            'supplier', 'keterangan', 'qty_akhir', 'mutasi_id'
        ]);
        $this->editMode = false;
    }

    public function store()
    {
        $this->validate([
            'kode_barang' => 'required|exists:master_stocks,kode_barang',
            'tanggal' => 'required|date',
            'satuan' => 'required|string',
            'jumlah_qty' => 'required|numeric',
            'tipe_transaksi' => 'required|in:IN,OUT,RETURN',
            'no_surat' => 'required|string',
            'jenis_surat' => 'required|string',
            'status_surat' => 'required|string',
        ]);

        $master = MasterStock::where('kode_barang', $this->kode_barang)->first();
        $currentQty = $master->qty_akhir ?? 0;

        if ($this->tipe_transaksi === 'IN' || $this->tipe_transaksi === 'RETURN') {
            $qty_akhir = $currentQty + $this->jumlah_qty;
        } elseif ($this->tipe_transaksi === 'OUT') {
            $qty_akhir = $currentQty - $this->jumlah_qty;
        }

        // Simpan ke tabel mutasi
        ModelsMutasiStock::create([
            'kode_barang' => $this->kode_barang,
            'nama_barang' => $master->nama_barang,
            'tanggal' => $this->tanggal,
            'f' => $this->f,
            'satuan' => $this->satuan,
            'jumlah_qty' => $this->jumlah_qty,
            'tipe_transaksi' => $this->tipe_transaksi,
            'no_surat' => $this->no_surat,
            'jenis_surat' => $this->jenis_surat,
            'status_surat' => $this->status_surat,
            'supplier' => $this->supplier,
            'keterangan' => $this->keterangan,
            'qty_akhir' => $qty_akhir,
        ]);

        // Update ke master stock
        $master->update(['qty_akhir' => $qty_akhir]);

        session()->flash('message', 'Mutasi stok berhasil ditambahkan.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $mutasi = ModelsMutasiStock::findOrFail($id);
        $this->mutasi_id = $id;
        $this->kode_barang = $mutasi->kode_barang;
        $this->nama_barang = $mutasi->nama_barang;
        $this->tanggal = $mutasi->tanggal;
        $this->f = $mutasi->f;
        $this->satuan = $mutasi->satuan;
        $this->jumlah_qty = $mutasi->jumlah_qty;
        $this->tipe_transaksi = $mutasi->tipe_transaksi;
        $this->no_surat = $mutasi->no_surat;
        $this->jenis_surat = $mutasi->jenis_surat;
        $this->status_surat = $mutasi->status_surat;
        $this->supplier = $mutasi->supplier;
        $this->keterangan = $mutasi->keterangan;
        $this->qty_akhir = $mutasi->qty_akhir;

        $this->editMode = true;
    }

    public function update()
    {
        $this->validate([
            'kode_barang' => 'required|exists:master_stocks,kode_barang',
            'tanggal' => 'required|date',
            'satuan' => 'required|string',
            'jumlah_qty' => 'required|numeric',
            'tipe_transaksi' => 'required|in:IN,OUT,RETURN',
            'no_surat' => 'required|string',
            'jenis_surat' => 'required|string',
            'status_surat' => 'required|string',
        ]);

        $mutasi = ModelsMutasiStock::findOrFail($this->mutasi_id);

        // Hitung ulang qty_akhir yang baru untuk mutasi ini
        $master = MasterStock::where('kode_barang', $this->kode_barang)->first();
        $lastQty = $master->qty_akhir;

        // Untuk update mutasi, idealnya kamu ingin reverse qty lama dulu.
        if ($mutasi->tipe_transaksi === 'IN' || $mutasi->tipe_transaksi === 'RETURN') {
            $lastQty -= $mutasi->jumlah_qty;
        } else if ($mutasi->tipe_transaksi === 'OUT') {
            $lastQty += $mutasi->jumlah_qty;
        }

        // Apply qty baru
        if ($this->tipe_transaksi === 'IN' || $this->tipe_transaksi === 'RETURN') {
            $qty_akhir = $lastQty + $this->jumlah_qty;
        } else if ($this->tipe_transaksi === 'OUT') {
            $qty_akhir = $lastQty - $this->jumlah_qty;
        }

        // Update mutasi
        $mutasi->update([
            'kode_barang' => $this->kode_barang,
            'tanggal' => $this->tanggal,
            'f' => $this->f,
            'satuan' => $this->satuan,
            'jumlah_qty' => $this->jumlah_qty,
            'tipe_transaksi' => $this->tipe_transaksi,
            'no_surat' => $this->no_surat,
            'jenis_surat' => $this->jenis_surat,
            'status_surat' => $this->status_surat,
            'supplier' => $this->supplier,
            'keterangan' => $this->keterangan,
            'qty_akhir' => $qty_akhir,
        ]);

        // Update master stock
        $master->update(['qty_akhir' => $qty_akhir]);

        session()->flash('message', 'Mutasi stok berhasil diperbarui.');
        $this->resetInput();
    }

    public function delete($id)
    {
        $mutasi = ModelsMutasiStock::findOrFail($id);

        // Update qty_akhir di master stock saat mutasi dihapus
        $master = MasterStock::where('kode_barang', $mutasi->kode_barang)->first();
        $currentQty = $master->qty_akhir;

        if ($mutasi->tipe_transaksi === 'IN' || $mutasi->tipe_transaksi === 'RETURN') {
            $currentQty -= $mutasi->jumlah_qty;
        } else if ($mutasi->tipe_transaksi === 'OUT') {
            $currentQty += $mutasi->jumlah_qty;
        }

        $master->update(['qty_akhir' => $currentQty]);

        $mutasi->delete();

        session()->flash('message', 'Mutasi stok berhasil dihapus.');
        $this->resetInput();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = ModelsMutasiStock::query();

        if ($this->search) {
            $query->where(function($q) {
                $q->where('kode_barang', 'like', '%'.$this->search.'%')
                ->orWhere('nama_barang', 'like', '%'.$this->search.'%');
            });
        }

        return view('livewire.mutasi-stock', [
            'mutasiStocks' => $query->latest()->paginate(5),
            'masterStocks' => MasterStock::all()
        ]);
    }
}
