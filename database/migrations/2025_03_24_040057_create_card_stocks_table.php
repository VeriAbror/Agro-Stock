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
        Schema::create('card_stocks', function (Blueprint $table) {
            $table->string('kode_barang', 50);
            $table->string('nama_barang', 100);
            $table->string('satuan', 20);
            $table->date('periode_awal');
            $table->date('periode_akhir');
            $table->float('qty_periode_awal');
            $table->float('qty_periode_akhir');
            $table->float('total_barang_in');
            $table->float('total_barang_out');
            $table->float('total_barang_return');
            $table->float('total_pemakaian');
            $table->timestamp('expired_at')->nullable();
            $table->timestamps();

            $table->foreign('kode_barang')->references('kode_barang')->on('master_stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('card_stocks');
    }
};
