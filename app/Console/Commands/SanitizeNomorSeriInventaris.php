<?php

namespace App\Console\Commands;

use App\Models\Aset;
use Illuminate\Console\Command;

class SanitizeNomorSeriInventaris extends Command
{
    protected $signature = 'aset:sanitize-nomor-seri';
    protected $description = 'Membersihkan _x000D_ dan karakter carriage return dari nomor_seri_inventaris yang sudah ada di database';

    public function handle()
    {
        $this->info('Mencari data dengan _x000D_ atau karakter tidak valid...');

        $affected = 0;

        // Cari aset yang mengandung _x000D_ di nomor_seri_inventaris
        $asets = Aset::where('nomor_seri_inventaris', 'like', '%_x000D_%')
            ->orWhere('nomor_seri_inventaris', 'like', "%\r%")
            ->orWhere('nomor_seri_inventaris', 'like', "%\n%")
            ->get();

        foreach ($asets as $aset) {
            $original = $aset->nomor_seri_inventaris;
            $cleaned = Aset::sanitizeString($original);

            if ($original !== $cleaned) {
                $aset->nomor_seri_inventaris = $cleaned;
                $aset->saveQuietly(); // Save tanpa trigger events lain
                $affected++;
                $this->line("  ✓ ID {$aset->id}: \"{$original}\" → \"{$cleaned}\"");
            }
        }

        // Juga bersihkan kode_aset
        $asetKode = Aset::where('kode_aset', 'like', '%_x000D_%')
            ->orWhere('kode_aset', 'like', "%\r%")
            ->orWhere('kode_aset', 'like', "%\n%")
            ->get();

        foreach ($asetKode as $aset) {
            $original = $aset->kode_aset;
            $cleaned = Aset::sanitizeString($original);

            if ($original !== $cleaned) {
                $aset->kode_aset = $cleaned;
                $aset->saveQuietly();
                $affected++;
                $this->line("  ✓ ID {$aset->id} (kode_aset): \"{$original}\" → \"{$cleaned}\"");
            }
        }

        if ($affected === 0) {
            $this->info('Tidak ada data yang perlu dibersihkan. Semua sudah bersih! ✨');
        } else {
            $this->info("Selesai! {$affected} data berhasil dibersihkan. ✅");
        }

        return Command::SUCCESS;
    }
}
