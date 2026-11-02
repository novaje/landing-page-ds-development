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
        Schema::create('tb_data_produk', function (Blueprint $table) {
            $table->id('id_produk');
            $table->string('kode_produk');
            $table->string('nm_produk');
            $table->string('nm_bahan');
            $table->string('ukuran');
            $table->decimal('harga_jual', 10, 2);
            $table->string('motif');
            $table->integer('stok');
            $table->string('status');
            $table->integer('sisa');
            $table->string('upload_gambar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_data_produk');
    }
};
