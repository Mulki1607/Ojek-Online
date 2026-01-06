<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->decimal('pickup_lat', 10, 7)->after('pickup_location');
            $table->decimal('pickup_lng', 10, 7)->after('pickup_lat');
        });
    }

    public function down(): void
    {
        Schema::table('pesanans', function (Blueprint $table) {
            $table->dropColumn(['pickup_lat', 'pickup_lng']);
        });
    }
};
