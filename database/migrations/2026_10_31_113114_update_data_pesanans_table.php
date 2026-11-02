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
        Schema::table('tb_data_pesanan', function (Blueprint $table) {
            // Hapus kolom lama
            $table->dropColumn(['total_modal_pesanan', 'total_jual', 'sisa']);

            // Tambah kolom baru
            $table->string('add_on_pesanan')->nullable()->after('qty_pesanan');
            $table->decimal('dp_pembayaran', 15, 2)->default(0)->after('add_on_pesanan');
            $table->decimal('dp_masuk', 15, 2)->default(0)->after('dp_pembayaran');
            $table->date('tgl_selesai')->nullable()->after('dp_masuk');
            $table->date('tgl_pelunasan')->nullable()->after('tgl_selesai');
            $table->decimal('nominal_pelunasan', 15, 2)->nullable()->after('tgl_pelunasan');
            $table->string('status_order')->default('Pending')->after('nominal_pelunasan');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_data_pesanan', function (Blueprint $table) {
            // Hapus kolom baru
            $table->dropColumn(['add_on_pesanan', 'dp_pembayaran', 'dp_masuk', 'tgl_selesai', 'tgl_pelunasan', 'nominal_pelunasan', 'status_order']);

            // Kembalikan kolom lama
            $table->decimal('total_modal_pesanan', 15, 2)->default(0)->after('qty_pesanan');
            $table->decimal('total_jual', 15, 2)->default(0)->after('total_modal_pesanan');
            $table->decimal('sisa', 15, 2)->default(0)->after('total_jual');
        });
    }
};
