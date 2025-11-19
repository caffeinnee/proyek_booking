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
        Schema::table('users', function (Blueprint $table) {
            // Tambahkan kolom baru untuk data Mitra
            $table->string('no_wa')->nullable()->after('email'); // Nomor WA
            $table->string('role')->default('user')->after('is_admin'); // Peran: 'user', 'mitra', 'admin'
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['no_wa', 'role']);
        });
    }
};
