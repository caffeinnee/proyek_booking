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
        Schema::table('lapangans', function (Blueprint $table) {
            $table->string('gambar_url')->nullable()->after('harga_per_jam');
            $table->string('lokasi')->nullable()->after('gambar_url');
            $table->decimal('rating', 3, 2)->default(4.50)->after('lokasi');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('lapangans', function (Blueprint $table) {
            $table->dropColumn(['gambar_url', 'lokasi', 'rating']);
        });
    }
};
