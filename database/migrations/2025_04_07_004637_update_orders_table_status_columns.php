<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->string('delivery_status')->default('pending')->after('status');
        $table->string('status')->default('processing')->change();
    });
}

public function down()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->dropColumn('delivery_status');
        $table->string('status')->default('pending')->change();
    });
}
};
