<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CardStock extends Model
{
    protected $primaryKey = 'kode_barang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_barang', 'nama_barang', 'satuan', 'periode_awal', 'periode_akhir',
        'qty_periode_awal', 'qty_periode_akhir', 'total_barang_in',
        'total_barang_out', 'total_barang_return', 'total_pemakaian', 'expired_at'
    ];

    

    public function masterStock()
    {
        return $this->belongsTo(MasterStock::class, 'kode_barang', 'kode_barang');
    }

    public function details()
    {
        return $this->hasMany(CardStockDetail::class, 'kode_barang', 'kode_barang')
                    ->orderBy('tanggal', 'asc');
    }

}
