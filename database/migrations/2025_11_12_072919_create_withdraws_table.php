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
        Schema::create('withdraws', function (Blueprint $table) {
            $table->id();
            $table->foreignId('wallet_id')->constrained('wallet')->onDelete('cascade');
            $table->decimal('amount', 15, 2);
            $table->string('bank_account')->nullable();
            $table->enum('status', ['pending', 'success', 'rejected'])->default('pending');
            $table->string('reference')->nullable(); // nomor WD
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('withdraws');
    }
};
