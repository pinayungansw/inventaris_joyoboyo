<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class MasterRuangan extends Model
{
    protected $table = 'master_ruangan';
    protected $fillable = ['lokasi_id', 'kode_ruangan', 'nama_ruangan'];

    public function lokasi(): BelongsTo
    {
        return $this->belongsTo(MasterLokasi::class , 'lokasi_id');
    }

    public function aset(): HasMany
    {
        return $this->hasMany(Aset::class , 'ruangan_id');
    }
}