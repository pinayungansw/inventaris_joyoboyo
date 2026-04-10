<?php

namespace App\Observers;

use App\Models\MasterKlasifikasi;

class MasterKlasifikasiObserver
{
    public function updated(MasterKlasifikasi $masterKlasifikasi)
    {
        if ($masterKlasifikasi->isDirty('kode_klasifikasi')) {
            $masterKlasifikasi->load('jenisBarang.aset');
            foreach ($masterKlasifikasi->jenisBarang as $jenis) {
                foreach ($jenis->aset as $aset) {
                    $aset->syncNomorSeriInventaris();
                }
            }
        }
    }
}
