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
    Schema::table('wallet_transactions', function (Blueprint $table) {
        $table->decimal('balance_before', 15, 2)->after('amount');
        $table->decimal('balance_after', 15, 2)->after('balance_before');
    });
}

public function down()
{
    Schema::table('wallet_transactions', function (Blueprint $table) {
        $table->dropColumn(['balance_before', 'balance_after']);
    });
}
};
