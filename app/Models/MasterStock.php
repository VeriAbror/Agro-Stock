<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MasterStock extends Model
{
    protected $primaryKey = 'kode_barang';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'kode_barang', 'nama_barang', 'f', 'satuan',
        'qty_awal', 'qty_akhir', 'satuan_harga', 'total',
    ];

    public function mutasiStocks()
    {
        return $this->hasMany(MutasiStock::class, 'kode_barang', 'kode_barang');
    }

    public function cardStock()
    {
        return $this->hasOne(CardStock::class, 'kode_barang', 'kode_barang');
    }

    public function cardStockDetails()
    {
        return $this->hasMany(CardStockDetail::class, 'kode_barang', 'kode_barang');
    }

    public function pesananUsers()
    {
        return $this->hasMany(PesananUser::class, 'kode_barang', 'kode_barang');
    }
}
