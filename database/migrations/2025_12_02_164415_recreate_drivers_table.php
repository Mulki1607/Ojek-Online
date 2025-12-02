<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('drivers', function (Blueprint $table) {

            // Basic identity
            if (!Schema::hasColumn('drivers', 'name')) {
                $table->string('name');
            }
            if (!Schema::hasColumn('drivers', 'email')) {
                $table->string('email')->unique();
            }
            if (!Schema::hasColumn('drivers', 'phone')) {
                $table->string('phone')->nullable();
            }
            if (!Schema::hasColumn('drivers', 'password')) {
                $table->string('password');
            }

            // Driver status
            if (!Schema::hasColumn('drivers', 'status')) {
                $table->string('status')->default('aktif'); 
                // opsi: aktif, suspend, banned
            }

            if (!Schema::hasColumn('drivers', 'online')) {
                $table->boolean('online')->default(false);
            }

            if (!Schema::hasColumn('drivers', 'work_status')) {
                $table->string('work_status')->default('available');
                // opsi: available, picking_up, on_trip, resting
            }

            // Location (untuk driver terdekat)
            if (!Schema::hasColumn('drivers', 'lat')) {
                $table->decimal('lat', 10, 7)->nullable();
            }
            if (!Schema::hasColumn('drivers', 'lng')) {
                $table->decimal('lng', 10, 7)->nullable();
            }

            // Vehicle info
            if (!Schema::hasColumn('drivers', 'vehicle_type')) {
                $table->string('vehicle_type')->nullable(); 
                // motor / mobil
            }
            if (!Schema::hasColumn('drivers', 'vehicle_brand')) {
                $table->string('vehicle_brand')->nullable();
            }
            if (!Schema::hasColumn('drivers', 'vehicle_plate')) {
                $table->string('vehicle_plate')->nullable();
            }

            // Rating driver
            if (!Schema::hasColumn('drivers', 'rating')) {
                $table->decimal('rating', 3, 2)->default(5.0);
            }
            if (!Schema::hasColumn('drivers', 'rating_count')) {
                $table->integer('rating_count')->default(0);
            }

            // Documents
            if (!Schema::hasColumn('drivers', 'ktp')) {
                $table->string('ktp')->nullable();
            }
            if (!Schema::hasColumn('drivers', 'sim')) {
                $table->string('sim')->nullable();
            }

            // Timestamps (auto check)
            if (!Schema::hasColumn('drivers', 'created_at')) {
                $table->timestamps();
            }
        });
    }

    public function down()
    {
        Schema::table('drivers', function (Blueprint $table) {

            $table->dropColumn([
                'phone',
                'status',
                'online',
                'work_status',
                'lat',
                'lng',
                'vehicle_type',
                'vehicle_brand',
                'vehicle_plate',
                'rating',
                'rating_count',
                'ktp',
                'sim',
            ]);
        });
    }
};
