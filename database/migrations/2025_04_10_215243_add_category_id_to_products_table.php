<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;


return new class extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            // Add category_id as nullable first
            $table->unsignedBigInteger('category_id')->nullable()->after('id');
            
            // Add foreign key constraint later after data is populated
        });

        // Populate category_id based on existing category names
        DB::statement('
            UPDATE products p
            JOIN categories c ON p.category = c.category_name
            SET p.category_id = c.id
        ');

        // Now make category_id not nullable and add foreign key
        Schema::table('products', function (Blueprint $table) {
            $table->unsignedBigInteger('category_id')->nullable(false)->change();
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories')
                  ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropColumn('category_id');
        });
    }
};