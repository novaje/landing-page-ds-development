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
        Schema::create('tb_master_data_paket_jersey', function (Blueprint $table) {
            $table->id('id_paket');
            $table->string('nm_paket');
            $table->string('harga_jual');
            $table->string('modal_vendor');
            $table->string('ongkir_pcs');
            $table->string('margin_pcs');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('tb_master_data_paket_jersey');
    }
};
