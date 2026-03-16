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

    /**
     * Generate a unique inventory serial number based on classification, type, quantity, month, and year.
     */
    public static function generateNomorSeriInventaris(int $jenisBarangId, int $jumlah): string
    {
        $jenisBarang = MasterJenisBarang::with('klasifikasi')->findOrFail($jenisBarangId);

        $klasifikasiCode = str_pad($jenisBarang->klasifikasi_id, 2, '0', STR_PAD_LEFT);
        $jenisCode = str_pad($jenisBarang->id, 2, '0', STR_PAD_LEFT);
        $jumlahCode = str_pad($jumlah, 2, '0', STR_PAD_LEFT);
        
        $bulanCode = date('m');
        $tahunCode = date('Y');

        $prefix = "{$klasifikasiCode}.{$jenisCode}.{$jumlahCode}";

        // Format is: klasifikasi.jenis.jumlah.urut.bulan.tahun
        $lastAset = self::where('nomor_seri_inventaris', 'like', "{$prefix}.%")
            ->orderByDesc('id')
            ->get();

        $nextSeq = 1;
        if ($lastAset->isNotEmpty()) {
            $maxSeq = 0;
            foreach ($lastAset as $aset) {
                // nomer urut ada di posisi ke-4 -> index 3
                $parts = explode('.', $aset->nomor_seri_inventaris);
                if (count($parts) >= 6) {
                    $seq = (int) $parts[3];
                    if ($seq > $maxSeq) {
                        $maxSeq = $seq;
                    }
                }
            }
            $nextSeq = $maxSeq + 1;
        }

        $urutCode = str_pad($nextSeq, 4, '0', STR_PAD_LEFT);

        return "{$prefix}.{$urutCode}.{$bulanCode}.{$tahunCode}";
    }
}