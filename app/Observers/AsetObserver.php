<?php

namespace App\Observers;

use App\Models\Aset;

class AsetObserver
{
    public function updated(Aset $aset)
    {
        // Jika jumlah, ruangan, atau jenis barang berubah, sync nomor seri
        if ($aset->isDirty(['jumlah', 'ruangan_id', 'jenis_barang_id'])) {
            $aset->syncNomorSeriInventaris();
        }
    }
}
