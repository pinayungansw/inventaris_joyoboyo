<?php

/**
 * Licensed to Pinayungan Sadewa Buwana
 * All rights reserved.
 */

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use App\Models\Aset;
use App\Models\MasterKlasifikasi;
use App\Models\MasterLokasi;
use App\Models\MasterJenisBarang;
use App\Models\MasterRuangan;
use App\Observers\AsetObserver;
use App\Observers\MasterKlasifikasiObserver;
use App\Observers\MasterLokasiObserver;
use App\Observers\MasterJenisBarangObserver;
use App\Observers\MasterRuanganObserver;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Aset::observe(AsetObserver::class);
        MasterKlasifikasi::observe(MasterKlasifikasiObserver::class);
        MasterLokasi::observe(MasterLokasiObserver::class);
        MasterJenisBarang::observe(MasterJenisBarangObserver::class);
        MasterRuangan::observe(MasterRuanganObserver::class);
    }
}
