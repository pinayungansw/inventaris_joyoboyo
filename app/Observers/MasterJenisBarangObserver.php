<?php

namespace App\Observers;

use App\Models\MasterJenisBarang;

class MasterJenisBarangObserver
{
    public function updated(MasterJenisBarang $masterJenisBarang)
    {
        if ($masterJenisBarang->isDirty('kode_jenis')) {
            $masterJenisBarang->load('aset');
            foreach ($masterJenisBarang->aset as $aset) {
                $aset->syncNomorSeriInventaris();
            }
        }
    }
}
