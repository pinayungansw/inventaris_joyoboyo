<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class MutasiAset extends Model
{
    protected $table = 'mutasi_aset';
    protected $fillable = [
        'aset_id',
        'dari_ruangan_id',
        'ke_ruangan_id',
        'tanggal_mutasi',
        'keterangan',
    ];

    protected $casts = [
        'tanggal_mutasi' => 'date',
    ];

    public function aset(): BelongsTo
    {
        return $this->belongsTo(Aset::class , 'aset_id');
    }

    public function dariRuangan(): BelongsTo
    {
        return $this->belongsTo(MasterRuangan::class , 'dari_ruangan_id');
    }

    public function keRuangan(): BelongsTo
    {
        return $this->belongsTo(MasterRuangan::class , 'ke_ruangan_id');
    }
}