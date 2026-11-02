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
            $table->decimal('total_order', 15, 2)->default(0)->after('status_order');
            $table->decimal('harga_netto', 15, 2)->default(0)->after('total_order');
            $table->decimal('total_hpp', 15, 2)->default(0)->after('harga_netto');
            $table->decimal('laba_kotor', 15, 2)->default(0)->after('total_hpp');
            $table->decimal('sisa_piutang', 15, 2)->default(0)->after('laba_kotor');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tb_data_pesanan', function (Blueprint $table) {
            $table->dropColumn(['total_order', 'harga_netto', 'total_hpp', 'laba_kotor', 'sisa_piutang']);
        });
    }
};
