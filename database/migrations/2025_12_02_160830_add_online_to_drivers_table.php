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
    Schema::table('drivers', function (Blueprint $table) {
        $table->boolean('online')->default(0)->after('status');
    });
}

public function down()
{
    Schema::table('drivers', function (Blueprint $table) {
        $table->dropColumn('online');
    });
}

};
