<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterLokasi extends Model
{
    protected $table = 'master_lokasi';
    protected $fillable = ['nama_lokasi'];

    public function ruangan(): HasMany
    {
        return $this->hasMany(MasterRuangan::class , 'lokasi_id');
    }
}