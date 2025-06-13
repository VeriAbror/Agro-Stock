<?php

namespace App\Imports;

use App\Models\MasterStock;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class MasterStockImport implements ToModel, WithHeadingRow
{
    public function model(array $row)
    {
        // Cek jika kode_barang sudah ada, skip insert
        if (MasterStock::where('kode_barang', $row['kobar'])->exists()) {
            return null;
        }

        return new MasterStock([
            'kode_barang'   => $row['kobar'],
            'nama_barang'   => $row['nama_barang'],
            'f'             => $row['f'],
            'satuan'        => $row['sat'],
            'qty_awal'      => $row['saldo_awal'] === '-' ? 0 : $row['saldo_awal'],
            'qty_akhir'     => $row['saldo_akhir'] === '-' ? 0 : $row['saldo_akhir'],
            'satuan_harga'  => $row['satuan_harga'] ?? null,
            'total'         => ($row['total'] === '-' ? 0 : $row['total']),
        ]);
    }
}