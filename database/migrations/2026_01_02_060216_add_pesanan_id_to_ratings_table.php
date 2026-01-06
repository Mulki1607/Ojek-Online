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
        Schema::table('ratings', function (Blueprint $table) {
            if (!Schema::hasColumn('ratings', 'pesanan_id')) {
                $table->foreignId('pesanan_id')
                      ->after('id')
                      ->constrained('pesanans')
                      ->cascadeOnDelete();
            }
        });
    }

    public function down(): void
    {
        Schema::table('ratings', function (Blueprint $table) {
            if (Schema::hasColumn('ratings', 'pesanan_id')) {
                $table->dropForeign(['pesanan_id']);
                $table->dropColumn('pesanan_id');
            }
        });
    }
};
