<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterJenisBarang extends Model
{
    protected $table = 'master_jenis_barang';
    protected $fillable = ['klasifikasi_id', 'kode_jenis', 'nama_jenis'];

    public function klasifikasi(): BelongsTo
    {
        return $this->belongsTo(MasterKlasifikasi::class , 'klasifikasi_id');
    }

    public function aset(): HasMany
    {
        return $this->hasMany(Aset::class , 'jenis_barang_id');
    }
}