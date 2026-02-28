<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\MasterLokasi;
use App\Models\MasterKlasifikasi;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAset = Aset::sum('jumlah');
        $totalBaik = Aset::where('kondisi', 'Baik')->sum('jumlah');
        $totalRusak = Aset::where('kondisi', 'Rusak')->sum('jumlah');
        $totalLayak = Aset::where('kondisi', 'Layak')->sum('jumlah');

        // Aset per lokasi
        $asetPerLokasi = MasterLokasi::select('master_lokasi.*')
            ->selectSub(function ($query) {
            $query->from('aset')
                ->join('master_ruangan', 'aset.ruangan_id', '=', 'master_ruangan.id')
                ->whereColumn('master_ruangan.lokasi_id', 'master_lokasi.id')
                ->selectRaw('COALESCE(SUM(aset.jumlah), 0)');
        }, 'total_aset')
            ->get();

        // Aset per klasifikasi
        $asetPerKlasifikasi = MasterKlasifikasi::select('master_klasifikasi.*')
            ->selectSub(function ($query) {
            $query->from('aset')
                ->join('master_jenis_barang', 'aset.jenis_barang_id', '=', 'master_jenis_barang.id')
                ->whereColumn('master_jenis_barang.klasifikasi_id', 'master_klasifikasi.id')
                ->selectRaw('COALESCE(SUM(aset.jumlah), 0)');
        }, 'total_aset')
            ->get();

        // Recent assets
        $recentAset = Aset::with(['jenisBarang.klasifikasi', 'ruangan.lokasi'])
            ->latest()
            ->take(10)
            ->get();

        return view('dashboard', compact(
            'totalAset',
            'totalBaik',
            'totalRusak',
            'totalLayak',
            'asetPerLokasi',
            'asetPerKlasifikasi',
            'recentAset'
        ));
    }
}