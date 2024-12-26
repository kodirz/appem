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
        // Periksa apakah kolom 'foto_profil' sudah ada sebelum menambahkannya
        if (!Schema::hasColumn('masyarakats', 'foto_profil')) {
            Schema::table('masyarakats', function (Blueprint $table) {
                $table->string('foto_profil')->nullable()->after('no_telepon');
            });
        }
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        // Periksa apakah kolom 'foto_profil' ada sebelum menghapusnya
        if (Schema::hasColumn('masyarakats', 'foto_profil')) {
            Schema::table('masyarakats', function (Blueprint $table) {
                $table->dropColumn('foto_profil');
            });
        }
    }
};
