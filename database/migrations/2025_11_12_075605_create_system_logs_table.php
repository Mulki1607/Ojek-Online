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
        Schema::create('system_logs', function (Blueprint $table) {
            $table->id();
            // Siapa yang melakukan aksi
            $table->foreignId('user_id')->nullable()->constrained('users')->nullOnDelete();
            
            // Jenis entitas yang terlibat (contoh: "order", "wallet", "top_up", dll)
            $table->string('entity_type')->nullable();
            $table->unsignedBigInteger('entity_id')->nullable();

            // Jenis aksi
            $table->string('action'); // contoh: created, updated, deleted, login, logout, failed

            // Detail tambahan atau pesan log
            $table->text('description')->nullable();

            // Metadata
            $table->string('ip_address', 45)->nullable();
            $table->text('user_agent')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('system_logs');
    }
};
