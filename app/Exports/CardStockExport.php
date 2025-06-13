<?php

namespace App\Exports;

use App\Models\CardStock;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;

class CardStockExport implements FromView
{
    protected $kode_barang;
    protected $nama_barang;
    protected $periode_awal;
    protected $periode_akhir;

    public function __construct($kode_barang, $nama_barang, $periode_awal, $periode_akhir)
    {
        $this->kode_barang   = $kode_barang;
        $this->nama_barang   = $nama_barang;
        $this->periode_awal  = $periode_awal;
        $this->periode_akhir = $periode_akhir;
    }

    public function view(): View
    {
        // HANYA AMBIL snapshot YANG PERSIS periode_awal & periode_akhir
        $query = CardStock::query()
            ->where('periode_awal', $this->periode_awal)
            ->where('periode_akhir', $this->periode_akhir);

        if (!empty($this->kode_barang)) {
            $query->where('kode_barang', 'like', '%' . $this->kode_barang . '%');
        }
        if (!empty($this->nama_barang)) {
            $query->where('nama_barang', 'like', '%' . $this->nama_barang . '%');
        }

        $card_stocks = $query->orderBy('kode_barang')->get();

        // Filter detail juga berdasarkan TANGGAL periode (jika dibutuhkan)
        foreach ($card_stocks as $card) {
            // Pastikan model CardStock punya relasi details()
            $card->details = $card->details()
                ->whereBetween('tanggal', [$this->periode_awal, $this->periode_akhir])
                ->orderBy('tanggal', 'asc')
                ->get();
        }

        return view('exports.card_stock', [
            'card_stocks'   => $card_stocks,
            'periode_awal'  => $this->periode_awal,
            'periode_akhir' => $this->periode_akhir,
        ]);
    }
}
