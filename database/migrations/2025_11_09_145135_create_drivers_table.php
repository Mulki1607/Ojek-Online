<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::create('drivers', function (Blueprint $table) {
        $table->id();
        $table->string('name');
        $table->string('email')->unique();
        $table->string('phone')->nullable();
        $table->string('password');
        $table->string('status')->default('aktif');
        $table->boolean('online')->default(0);

        $table->string('work_status')->nullable();
        $table->decimal('lat', 10, 7)->nullable();
        $table->decimal('lng', 10, 7)->nullable();

        $table->string('vehicle_type')->nullable();
        $table->string('vehicle_brand')->nullable();
        $table->string('vehicle_plate')->nullable();

        $table->decimal('rating', 3, 2)->default(5.00);
        $table->integer('rating_count')->default(0);

        $table->string('ktp')->nullable();
        $table->string('sim')->nullable();

        $table->timestamps();
    });
}


    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('drivers');
    }
};
