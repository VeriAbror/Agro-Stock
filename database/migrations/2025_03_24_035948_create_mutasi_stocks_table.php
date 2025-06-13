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
        Schema::create('mutasi_stocks', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang', 50);
            $table->string('nama_barang', 100);
            $table->date('tanggal');
            $table->string('f', 10)->nullable();
            $table->string('satuan', 20);
            $table->float('jumlah_qty');
            $table->enum('tipe_transaksi', ['IN', 'OUT', 'RETURN']);
            $table->string('no_surat', 50);
            $table->string('jenis_surat', 50);
            $table->string('status_surat', 20);
            $table->string('supplier', 100)->nullable();
            $table->text('keterangan')->nullable();
            $table->float('qty_akhir');
            $table->timestamps();

            $table->foreign('kode_barang')->references('kode_barang')->on('master_stocks')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('mutasi_stocks');
    }
};
