<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterKlasifikasi extends Model
{
    protected $table = 'master_klasifikasi';
    protected $fillable = ['kode_klasifikasi', 'nama_klasifikasi'];

    public function jenisBarang(): HasMany
    {
        return $this->hasMany(MasterJenisBarang::class , 'klasifikasi_id');
    }
}