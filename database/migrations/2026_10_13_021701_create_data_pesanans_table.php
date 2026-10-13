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
        Schema::create('tb_data_pesanan', function (Blueprint $table) {
            $table->id('id_pesanan');
            $table->date('tgl_pesanan');
            $table->string('kode_pesanan');
            $table->string('nama_team');
            $table->string('jenis_pesanan');
            $table->integer('qty_pesanan');
            $table->decimal('total_modal_pesanan');
            $table->decimal('total_jual');
            $table->decimal('sisa');
            $table->string('status_pesanan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_data_pesanan');
    }
};
