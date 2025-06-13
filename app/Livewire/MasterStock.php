<?php

namespace App\Livewire;

use Livewire\Component;
use Livewire\WithPagination;
use Livewire\WithFileUploads;
use App\Models\MasterStock as MasterStockModel;
use App\Imports\MasterStockImport;
use Maatwebsite\Excel\Facades\Excel;

class MasterStock extends Component
{
    use WithPagination, WithFileUploads;

    public $kode_barang, $nama_barang, $f, $satuan, $qty_awal, $qty_akhir, $satuan_harga, $total;
    public $editMode = false;
    public $editingId = null;
    public $search;
    public $file; // Untuk upload Excel
    protected $paginationTheme = 'tailwind';

    protected $rules = [
        'kode_barang' => 'required|string|max:50',
        'nama_barang' => 'required|string|max:100',
        'f' => 'nullable|string|max:10',
        'satuan' => 'required|string|max:20',
        'qty_awal' => 'required|numeric',
        'qty_akhir' => 'required|numeric',
        'satuan_harga' => 'required|numeric',
    ];

    public function updatedKodeBarang($value)
    {
        $barang = MasterStockModel::where('kode_barang', $value)->first();

        if ($barang) {
            $this->nama_barang = $barang->nama_barang;
        } else {
            if (!$this->editMode) {
                $this->nama_barang = '';
            }
        }
    }

    public function importExcel()
    {
        $this->validate([
            // 51200 KB = 50 MB, bisa kamu sesuaikan
            'file' => 'required|file|mimes:xlsx,xls|max:51200'
        ]);

        Excel::import(new MasterStockImport, $this->file->getRealPath());

        session()->flash('message', 'Import Excel berhasil!');
        $this->reset('file');
    }

    public function render()
    {
        $data = MasterStockModel::query()
            ->when($this->search, function ($query) {
                $query->where(function ($q) {
                    $q->where('nama_barang', 'like', '%'.$this->search.'%')
                        ->orWhere('kode_barang', 'like', '%'.$this->search.'%');
                });
            })
            ->orderBy('kode_barang')
            ->paginate(5);

        return view('livewire.master-stock', ['data' => $data]);
    }

    public function updatingSearch()
    {
        $this->resetPage();
    }

    public function resetInput()
    {
        $this->kode_barang = '';
        $this->nama_barang = '';
        $this->f = '';
        $this->satuan = '';
        $this->qty_awal = '';
        $this->qty_akhir = '';
        $this->satuan_harga = '';
        $this->total = '';
        $this->editMode = false;
        $this->editingId = null;
    }

    public function store()
    {
        $this->validate();

        MasterStockModel::create([
            'kode_barang' => $this->kode_barang,
            'nama_barang' => $this->nama_barang,
            'f' => $this->f,
            'satuan' => $this->satuan,
            'qty_awal' => $this->qty_awal,
            'qty_akhir' => $this->qty_akhir,
            'satuan_harga' => $this->satuan_harga,
            'total' => $this->qty_akhir * $this->satuan_harga,
        ]);

        session()->flash('message', 'Data berhasil ditambahkan.');
        $this->resetInput();
    }

    public function edit($id)
    {
        $item = MasterStockModel::findOrFail($id);
        $this->editingId = $id;
        $this->editMode = true;
        $this->kode_barang = $item->kode_barang;
        $this->nama_barang = $item->nama_barang;
        $this->f = $item->f;
        $this->satuan = $item->satuan;
        $this->qty_awal = $item->qty_awal;
        $this->qty_akhir = $item->qty_akhir;
        $this->satuan_harga = $item->satuan_harga;
    }

    public function update()
    {
        $this->validate();

        $item = MasterStockModel::findOrFail($this->editingId);

        $item->update([
            'kode_barang' => $this->kode_barang,
            'nama_barang' => $this->nama_barang,
            'f' => $this->f,
            'satuan' => $this->satuan,
            'qty_awal' => $this->qty_awal,
            'qty_akhir' => $this->qty_akhir,
            'satuan_harga' => $this->satuan_harga,
            'total' => $this->qty_akhir * $this->satuan_harga,
        ]);

        session()->flash('message', 'Data berhasil diupdate.');
        $this->resetInput();
        $this->resetPage();
    }

    public function delete($id)
    {
        MasterStockModel::findOrFail($id)->delete();
        session()->flash('message', 'Data berhasil dihapus.');
    }
}