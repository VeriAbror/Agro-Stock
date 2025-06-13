<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('master_stocks', function (Blueprint $table) {
            $table->string('kode_barang', 50)->primary();
            $table->string('nama_barang', 100);
            $table->string('f', 10)->nullable();
            $table->string('satuan', 20);
            $table->float('qty_awal');
            $table->float('qty_akhir');
            $table->decimal('satuan_harga', 15, 2);
            $table->decimal('total', 15, 2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('master_stocks');
    }
};
