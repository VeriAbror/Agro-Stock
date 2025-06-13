<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MutasiStock extends Model
{
    protected $fillable = [
        'kode_barang', 'nama_barang', 'tanggal', 'f', 'satuan',
        'jumlah_qty', 'tipe_transaksi', 'no_surat', 'jenis_surat',
        'status_surat', 'supplier', 'keterangan', 'qty_akhir'
    ];

    public function masterStock()
    {
        return $this->belongsTo(MasterStock::class, 'kode_barang', 'kode_barang');
    }
}
