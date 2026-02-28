<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('aset', function (Blueprint $table) {
            $table->renameColumn('harga_perolehan', 'nomor_seri_inventaris');
        });
        Schema::table('aset', function (Blueprint $table) {
            $table->string('nomor_seri_inventaris')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('aset', function (Blueprint $table) {
            $table->decimal('nomor_seri_inventaris', 15, 2)->nullable()->change();
        });
        Schema::table('aset', function (Blueprint $table) {
            $table->renameColumn('nomor_seri_inventaris', 'harga_perolehan');
        });
    }
};