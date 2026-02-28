<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('aset', function (Blueprint $table) {
            $table->id();
            $table->string('kode_aset')->unique();
            $table->foreignId('jenis_barang_id')->constrained('master_jenis_barang')->cascadeOnDelete();
            $table->foreignId('ruangan_id')->constrained('master_ruangan')->cascadeOnDelete();
            $table->string('merk')->nullable();
            $table->text('spesifikasi')->nullable();
            $table->year('tahun_pembelian');
            $table->enum('kondisi', ['Baik', 'Rusak', 'Layak'])->default('Baik');
            $table->integer('jumlah')->default(1);
            $table->decimal('harga_perolehan', 15, 2)->nullable();
            $table->text('keterangan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aset');
    }
};