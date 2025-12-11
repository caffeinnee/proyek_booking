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
        Schema::table('lapangans', function (Blueprint $table) {
            // Kolom untuk iklan sorotan (Default: false/tidak)
            $table->boolean('is_featured')->default(false)->after('harga_per_jam');
        });
    }

    public function down()
    {
        Schema::table('lapangans', function (Blueprint $table) {
            $table->dropColumn('is_featured');
        });
    }
};
