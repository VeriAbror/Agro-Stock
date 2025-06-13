<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PesananUser extends Model
{
    protected $table = 'pesanan_users';
    protected $fillable = [
        'user_id',
        'kode_barang', 'nama_barang', 'tanggal', 'f', 'satuan',
        'jumlah_qty', 'tipe_transaksi', 'no_surat', 'jenis_surat',
        'status_surat', 'supplier', 'keterangan', 'qty_akhir'
    ];

    public function masterStock()
    {
        return $this->belongsTo(MasterStock::class, 'kode_barang', 'kode_barang');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}