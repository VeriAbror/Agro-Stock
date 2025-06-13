<?php

namespace App\Livewire;

use Livewire\Component;
use App\Models\MasterStock;
use App\Models\MutasiStock;
use Carbon\Carbon;

class PopularStock extends Component
{
    public function render()
    {
        // Stok terbanyak (top 5 berdasarkan qty_akhir)
        $stokTerbanyak = MasterStock::orderByDesc('qty_akhir')->take(5)->get();

        // Baru ditambahkan (top 5 berdasarkan created_at terbaru)
        $baruDitambahkan = MasterStock::orderByDesc('created_at')->take(5)->get();

        // Banyak digunakan (top 5 kode_barang dengan jumlah mutasi keluar terbanyak 120 hari terakhir)
        $thirtyDaysAgo = now()->subDays(120);
        $banyakDigunakan = MutasiStock::where('tipe_transaksi', 'OUT')
            ->where('tanggal', '>=', $thirtyDaysAgo)
            ->selectRaw('kode_barang, SUM(jumlah_qty) as total_keluar')
            ->groupBy('kode_barang')
            ->orderByDesc('total_keluar')
            ->take(5)
            ->get()
            ->map(function($mutasi) {
                $mutasi->barang = \App\Models\MasterStock::where('kode_barang', $mutasi->kode_barang)->first();
                return $mutasi;
            });

        // Stok menipis (top 5 stok terendah, qty_akhir > 0)
        $stokMenipis = MasterStock::where('qty_akhir', '>', 0)
            ->orderBy('qty_akhir', 'asc')
            ->take(5)
            ->get();

        

        // Periode mingguan, bulanan, tahunan
        $periodeMinggu = now()->subWeek();      // 7 hari terakhir
        $periodeBulan  = now()->subMonth();     // 30 hari terakhir
        $periodeTahun  = now()->subYear();      // 1 tahun terakhir

        // FAST MOVING: Mingguan
        $fastMovingMingguan = MutasiStock::where('tipe_transaksi', 'OUT')
            ->where('tanggal', '>=', $periodeMinggu)
            ->selectRaw('kode_barang, COUNT(*) as total_transaksi')
            ->groupBy('kode_barang')
            ->having('total_transaksi', '>', 2) // contoh: lebih dari 2x keluar dalam seminggu
            ->orderByDesc('total_transaksi')
            ->get()
            ->map(function($mutasi) {
                $mutasi->barang = \App\Models\MasterStock::where('kode_barang', $mutasi->kode_barang)->first();
                return $mutasi;
            });

        // FAST MOVING: Bulanan
        $fastMovingBulanan = MutasiStock::where('tipe_transaksi', 'OUT')
            ->where('tanggal', '>=', $periodeBulan)
            ->selectRaw('kode_barang, COUNT(*) as total_transaksi')
            ->groupBy('kode_barang')
            ->having('total_transaksi', '>', 6) // contoh: lebih dari 6x keluar dalam seminggu
            ->orderByDesc('total_transaksi')
            ->get()
            ->map(function($mutasi) {
                $mutasi->barang = \App\Models\MasterStock::where('kode_barang', $mutasi->kode_barang)->first();
                return $mutasi;
            });

        // FAST MOVING: Tahunan
        $fastMovingTahunan = MutasiStock::where('tipe_transaksi', 'OUT')
            ->where('tanggal', '>=', $periodeTahun)
            ->selectRaw('kode_barang, COUNT(*) as total_transaksi')
            ->groupBy('kode_barang')
            ->having('total_transaksi', '>', 1) // contoh: lebih dari 12x keluar dalam seminggu
            ->orderByDesc('total_transaksi')
            ->get()
            ->map(function($mutasi) {
                $mutasi->barang = \App\Models\MasterStock::where('kode_barang', $mutasi->kode_barang)->first();
                return $mutasi;
            });

        // SLOW MOVING: Barang yang keluar kurang dari 2x per tahun (tapi ada keluar)
        $slowMoving = MutasiStock::where('tipe_transaksi', 'OUT')
            ->where('tanggal', '>=', $periodeTahun)
            ->selectRaw('kode_barang, COUNT(*) as total_transaksi')
            ->groupBy('kode_barang')
            ->having('total_transaksi', '<', 2)
            ->having('total_transaksi', '>', 0)
            ->orderBy('total_transaksi', 'asc')
            ->get()
            ->map(function($mutasi) {
                $mutasi->barang = \App\Models\MasterStock::where('kode_barang', $mutasi->kode_barang)->first();
                return $mutasi;
            });

        // DEAD STOCK: Barang yang tidak pernah keluar sama sekali dalam 1 tahun terakhir
        $allKodeBarang = MasterStock::pluck('kode_barang')->toArray();
        $keluar1tahun = MutasiStock::where('tipe_transaksi', 'OUT')
            ->where('tanggal', '>=', $periodeTahun)
            ->pluck('kode_barang')
            ->unique()
            ->toArray();

        $deadStockKode = array_diff($allKodeBarang, $keluar1tahun);
        $deadStock = MasterStock::whereIn('kode_barang', $deadStockKode)
            ->take(5)
            ->get();


        return view('livewire.popular-stock', [
            'stokTerbanyak'    => $stokTerbanyak,
            'baruDitambahkan'  => $baruDitambahkan,
            'banyakDigunakan'  => $banyakDigunakan,
            'stokMenipis'      => $stokMenipis,
            'fastMovingMingguan'       => $fastMovingMingguan,
            'fastMovingBulanan'          => $fastMovingBulanan,
            'fastMovingTahunan'         => $fastMovingTahunan,
            'slowMoving'       => $slowMoving,
            'deadStock'        => $deadStock,
        ]);
    }
}