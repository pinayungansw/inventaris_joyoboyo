<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Aset extends Model
{
    protected $table = 'aset';
    protected $fillable = [
        'kode_aset',
        'jenis_barang_id',
        'ruangan_id',
        'merk',
        'spesifikasi',
        'tahun_pembelian',
        'kondisi',
        'jumlah',
        'nomor_seri_inventaris',
        'keterangan',
    ];

    public function jenisBarang(): BelongsTo
    {
        return $this->belongsTo(MasterJenisBarang::class , 'jenis_barang_id');
    }

    public function ruangan(): BelongsTo
    {
        return $this->belongsTo(MasterRuangan::class , 'ruangan_id');
    }

    public function mutasi(): HasMany
    {
        return $this->hasMany(MutasiAset::class , 'aset_id');
    }

    /**
     * Generate a unique asset code based on location, classification and sequence.
     */
    public static function generateKodeAset(int $ruanganId, int $jenisBarangId, int $tahun): string
    {
        $ruangan = MasterRuangan::with('lokasi')->findOrFail($ruanganId);
        $jenisBarang = MasterJenisBarang::with('klasifikasi')->findOrFail($jenisBarangId);

        $lokasiCode = str_pad($ruangan->lokasi_id, 2, '0', STR_PAD_LEFT);
        $klasifikasiCode = str_pad($jenisBarang->klasifikasi_id, 2, '0', STR_PAD_LEFT);
        $tahunCode = substr((string)$tahun, -2);

        $prefix = "{$lokasiCode}.{$klasifikasiCode}.{$tahunCode}";

        $lastAset = self::where('kode_aset', 'like', "{$prefix}.%")
            ->orderByDesc('kode_aset')
            ->first();

        if ($lastAset) {
            $lastSeq = (int)substr($lastAset->kode_aset, strrpos($lastAset->kode_aset, '.') + 1);
            $nextSeq = $lastSeq + 1;
        }
        else {
            $nextSeq = 1;
        }

        return $prefix . '.' . str_pad($nextSeq, 4, '0', STR_PAD_LEFT);
    }
}