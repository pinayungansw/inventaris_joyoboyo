<?php

namespace App\Observers;

use App\Models\MasterLokasi;

class MasterLokasiObserver
{
    public function updated(MasterLokasi $masterLokasi)
    {
        if ($masterLokasi->isDirty('kode_lokasi')) {
            $masterLokasi->load('ruangan.aset');
            foreach ($masterLokasi->ruangan as $ruangan) {
                foreach ($ruangan->aset as $aset) {
                    $aset->syncNomorSeriInventaris();
                }
            }
        }
    }
}
