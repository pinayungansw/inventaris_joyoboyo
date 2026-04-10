<?php

namespace App\Observers;

use App\Models\MasterRuangan;

class MasterRuanganObserver
{
    public function updated(MasterRuangan $masterRuangan)
    {
        if ($masterRuangan->isDirty('kode_ruangan')) {
            $masterRuangan->load('aset');
            foreach ($masterRuangan->aset as $aset) {
                $aset->syncNomorSeriInventaris();
            }
        }
    }
}
