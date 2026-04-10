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
        Schema::table('master_klasifikasi', function (Blueprint $table) {
            $table->string('kode_klasifikasi')->nullable()->after('id');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('master_klasifikasi', function (Blueprint $table) {
            $table->dropColumn('kode_klasifikasi');
        });
    }
};
