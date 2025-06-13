<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\PesananUser as PesananUserModel;
use App\Models\MasterStock;
use Illuminate\Support\Facades\Auth;

class PesananUser extends Component
{
    use WithPagination;
    
    public $tanggal;
    public $kode_barang = '';
    public $jumlah_qty = 1;
    public $keterangan = '';
    public $barang_list = [];
    public $satuan_list = [];
    public $satuan = '';
    public $tipe_transaksi = '';
    public $no_surat = '';
    public $jenis_surat = '';
    public $status_surat = '';
    public $supplier = '';

    public $editMode = false;
    public $editId = null;
    public $search = '';

    protected $paginationTheme = 'tailwind';

    protected $rules = [
        'tanggal' => 'required|date',
        'kode_barang' => 'required|exists:master_stocks,kode_barang',
        'jumlah_qty' => 'required|numeric|min:1',
        'tipe_transaksi' => 'required|in:IN,OUT',
        'satuan' => 'required|string',
        // kolom lain validasi sesuai kebutuhan
    ];

    public function mount()
    {
        $this->tanggal = now()->format('Y-m-d');
        $this->barang_list = MasterStock::all();
        $this->satuan_list = MasterStock::distinct()->pluck('satuan')->toArray();
    }

    public function updatedKodeBarang($value)
    {
        $barang = MasterStock::where('kode_barang', $value)->first();
        if ($barang) {
            $this->satuan = $barang->satuan;
        } else {
            $this->satuan = '';
        }
    }

    public function store()
    {
        $this->validate();

        $barang = MasterStock::where('kode_barang', $this->kode_barang)->first();

        $status = (Auth::user()->role === 'admin') ? $this->status_surat : 'PENDING';

        PesananUserModel::create([
            'user_id'        => Auth::id(),
            'kode_barang'    => $barang->kode_barang,
            'nama_barang'    => $barang->nama_barang,
            'tanggal'        => $this->tanggal,
            'f'              => $barang->f ?? null,
            'satuan'         => $this->satuan,
            'jumlah_qty'     => $this->jumlah_qty,
            'tipe_transaksi' => $this->tipe_transaksi,
            'no_surat'       => $this->no_surat,
            'jenis_surat'    => $this->jenis_surat,
            'status_surat'   => $status, // otomatis PENDING untuk user
            'supplier'       => $this->supplier,
            'keterangan'     => $this->keterangan,
        ]);

        session()->flash('message', 'Pesanan berhasil disimpan.');
        $this->resetForm();
    }

    public function edit($id)
    {
        $pesanan = PesananUserModel::findOrFail($id);

        // Hanya admin & petugas_gudang atau pemilik data yang boleh edit
        if (!in_array(Auth::user()->role, ['admin']) && $pesanan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengedit data ini.');
        }

        $this->editId         = $pesanan->id;
        $this->editMode       = true;
        $this->tanggal        = $pesanan->tanggal;
        $this->kode_barang    = $pesanan->kode_barang;
        $this->jumlah_qty     = $pesanan->jumlah_qty;
        $this->keterangan     = $pesanan->keterangan;
        $this->tipe_transaksi = $pesanan->tipe_transaksi;
        $this->satuan         = $pesanan->satuan;
        $this->no_surat       = $pesanan->no_surat;
        $this->jenis_surat    = $pesanan->jenis_surat;
        $this->status_surat   = $pesanan->status_surat;
        $this->supplier       = $pesanan->supplier;
    }

    public function update()
    {
        $this->validate();

        $pesanan = PesananUserModel::findOrFail($this->editId);

        if (!in_array(Auth::user()->role, ['admin']) && $pesanan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak mengubah data ini.');
        }

        $barang = MasterStock::where('kode_barang', $this->kode_barang)->first();

        $status = (Auth::user()->role === 'admin') ? $this->status_surat : $pesanan->status_surat;

        $pesanan->update([
            'kode_barang'    => $barang->kode_barang,
            'nama_barang'    => $barang->nama_barang,
            'tanggal'        => $this->tanggal,
            'f'              => $barang->f ?? null,
            'satuan'         => $this->satuan,
            'jumlah_qty'     => $this->jumlah_qty,
            'tipe_transaksi' => $this->tipe_transaksi,
            'no_surat'       => $this->no_surat,
            'jenis_surat'    => $this->jenis_surat,
            'status_surat'   => $status, // hanya admin bisa ubah
            'supplier'       => $this->supplier,
            'keterangan'     => $this->keterangan,
        ]);

        session()->flash('message', 'Pesanan berhasil diupdate.');
        $this->resetForm();
        return redirect()->to(request()->header('Referer')); // Redirect kembali
    }

    public function delete($id)
    {
        $pesanan = PesananUserModel::findOrFail($id);

        // Hanya admin & petugas_gudang atau pemilik data yang boleh hapus
        if (!in_array(Auth::user()->role, ['admin']) && $pesanan->user_id !== Auth::id()) {
            abort(403, 'Anda tidak berhak menghapus data ini.');
        }

        $pesanan->delete();

        session()->flash('message', 'Pesanan berhasil dihapus.');
        $this->resetForm();
    }

    public function resetForm()
    {
        $this->reset([
            'tanggal', 'kode_barang', 'jumlah_qty', 'keterangan',
            'tipe_transaksi', 'no_surat', 'jenis_surat', 'status_surat', 'supplier', 'satuan'
        ]);
        $this->tanggal = now()->format('Y-m-d');
        $this->editMode = false;
        $this->editId = null;
        $this->resetPage();
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function render()
    {
        $query = PesananUserModel::with('user')
            ->when($this->search, function($q){
                $q->where(function($q2){
                    $q2->where('kode_barang', 'like', '%'.$this->search.'%')
                        ->orWhere('nama_barang', 'like', '%'.$this->search.'%')
                        ->orWhere('no_surat', 'like', '%'.$this->search.'%')
                        ->orWhere('jenis_surat', 'like', '%'.$this->search.'%');
                });
            });

        // Hanya admin & petugas_gudang yang bisa lihat semua data
        if (!in_array(Auth::user()->role, ['admin', 'petugas_gudang'])) {
            $query->where('user_id', Auth::id());
        }

        $pesanan_user = $query->orderBy('created_at', 'desc')->paginate(10);

        return view('livewire.pesanan-user', [
            'pesanan_user' => $pesanan_user,
            'barang_list' => $this->barang_list,
            'satuan_list' => $this->satuan_list,
        ]);
    }

    
}