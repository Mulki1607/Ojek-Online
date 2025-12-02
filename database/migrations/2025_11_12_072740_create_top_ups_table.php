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
        Schema::create('top_ups', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained('wallet')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('method')->nullable(); // e.g. 'bank_transfer', 'qris'
            $table->enum('status', ['pending', 'success', 'failed'])->default('pending');
            $table->string('reference')->nullable(); // ID dari payment gateway
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('top_ups');
    }
};
