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

    /**
     * Boot method to sanitize fields before saving.
     */
    protected static function boot()
    {
        parent::boot();

        static::saving(function ($aset) {
            // Bersihkan _x000D_ dan karakter carriage return dari nomor_seri_inventaris
            if ($aset->nomor_seri_inventaris) {
                $aset->nomor_seri_inventaris = self::sanitizeString($aset->nomor_seri_inventaris);
            }
            // Bersihkan juga kode_aset untuk jaga-jaga
            if ($aset->kode_aset) {
                $aset->kode_aset = self::sanitizeString($aset->kode_aset);
            }
        });
    }

    /**
     * Membersihkan string dari artefak Excel/Windows (_x000D_, carriage return, dll.)
     */
    public static function sanitizeString(string $value): string
    {
        // Hapus _x000D_ (artefak dari Excel XML)
        $value = str_replace('_x000D_', '', $value);
        // Hapus karakter carriage return (\r)
        $value = str_replace("\r", '', $value);
        // Hapus karakter newline (\n) yang tidak seharusnya ada
        $value = str_replace("\n", '', $value);
        // Trim spasi di awal dan akhir
        return trim($value);
    }

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
     * Generate a unique inventory serial number based on:
     * KK JJ QQQ L.L SSSS MM YYYY
     */
    public static function generateNomorSeriInventaris(int $ruanganId, int $jenisBarangId, int $jumlah): string
    {
        $ruangan = MasterRuangan::with('lokasi')->findOrFail($ruanganId);
        $jenisBarang = MasterJenisBarang::with('klasifikasi')->findOrFail($jenisBarangId);

        $klasifikasiCode = str_pad($jenisBarang->klasifikasi->kode_klasifikasi ?? '00', 2, '0', STR_PAD_LEFT);
        $jenisCode = str_pad($jenisBarang->kode_jenis ?? '00', 2, '0', STR_PAD_LEFT);
        $jumlahCode = str_pad($jumlah, 3, '0', STR_PAD_LEFT);
        $lokasiCode = $ruangan->lokasi->kode_lokasi ?? '0';
        $ruanganCode = $ruangan->kode_ruangan ?? '0';
        
        $month = date('m');
        $year = date('Y');

        $prefix = "{$klasifikasiCode} {$jenisCode} {$jumlahCode} {$lokasiCode}.{$ruanganCode}";

        // Cari urutan SSSS
        $lastAset = self::where('nomor_seri_inventaris', 'like', "{$prefix} %")
            ->orderByDesc('id')
            ->first();

        $nextSeq = 1;
        if ($lastAset) {
            $parts = explode(' ', $lastAset->nomor_seri_inventaris);
            if (count($parts) >= 5) {
                $nextSeq = (int) $parts[4] + 1;
            }
        }

        $urutCode = str_pad($nextSeq, 4, '0', STR_PAD_LEFT);

        return "{$prefix} {$urutCode} {$month} {$year}";
    }

    /**
     * Sync/Regenerate nomor seri inventaris based on current master data
     */
    public function syncNomorSeriInventaris()
    {
        // Ambil data tanpa incrementing sequence (SSSS) jika sudah terlanjur ada? 
        // User minta "otomatis ganti" tapi urutan biasanya tetap.
        // Kita pecah dulu nomor yang ada untuk ambil urutan lamanya.
        $parts = explode(' ', $this->nomor_seri_inventaris);
        $oldSeq = (count($parts) >= 5) ? $parts[4] : '0001';
        $oldMonth = (count($parts) >= 6) ? $parts[5] : date('m');
        $oldYear = (count($parts) >= 7) ? $parts[6] : date('Y');

        $ruangan = $this->ruangan()->with('lokasi')->first();
        $jenisBarang = $this->jenisBarang()->with('klasifikasi')->first();

        if (!$ruangan || !$jenisBarang) return;

        $klasifikasiCode = str_pad($jenisBarang->klasifikasi->kode_klasifikasi ?? '00', 2, '0', STR_PAD_LEFT);
        $jenisCode = str_pad($jenisBarang->kode_jenis ?? '00', 2, '0', STR_PAD_LEFT);
        $jumlahCode = str_pad($this->jumlah, 3, '0', STR_PAD_LEFT);
        $lokasiCode = $ruangan->lokasi->kode_lokasi ?? '0';
        $ruanganCode = $ruangan->kode_ruangan ?? '0';

        $this->nomor_seri_inventaris = "{$klasifikasiCode} {$jenisCode} {$jumlahCode} {$lokasiCode}.{$ruanganCode} {$oldSeq} {$oldMonth} {$oldYear}";
        $this->saveQuietly();
    }
}