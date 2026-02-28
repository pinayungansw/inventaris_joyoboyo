<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\MasterLokasi;
use App\Models\MasterKlasifikasi;
use App\Models\MasterRuangan;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\AsetExport;

class LaporanController extends Controller
{
    public function index(Request $request)
    {
        $query = Aset::with(['jenisBarang.klasifikasi', 'ruangan.lokasi']);

        if ($request->filled('lokasi_id')) {
            $query->whereHas('ruangan', fn($q) => $q->where('lokasi_id', $request->lokasi_id));
        }
        if ($request->filled('ruangan_id')) {
            $query->where('ruangan_id', $request->ruangan_id);
        }
        if ($request->filled('klasifikasi_id')) {
            $query->whereHas('jenisBarang', fn($q) => $q->where('klasifikasi_id', $request->klasifikasi_id));
        }
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }
        if ($request->filled('tahun_pembelian')) {
            $query->where('tahun_pembelian', $request->tahun_pembelian);
        }

        $aset = $query->orderBy('kode_aset')->get();
        $lokasi = MasterLokasi::all();
        $klasifikasi = MasterKlasifikasi::all();
        $ruangan = MasterRuangan::with('lokasi')->get();

        return view('laporan.index', compact('aset', 'lokasi', 'klasifikasi', 'ruangan'));
    }

    public function exportExcel(Request $request)
    {
        $selectedLokasi = $request->filled('lokasi_id') ? MasterLokasi::find($request->lokasi_id)?->nama_lokasi : null;
        $selectedRuangan = $request->filled('ruangan_id') ? MasterRuangan::find($request->ruangan_id)?->nama_ruangan : null;

        return Excel::download(new AsetExport($request->all(), $selectedLokasi, $selectedRuangan), 'laporan-aset-' . date('Y-m-d') . '.xlsx');
    }

    public function exportPdf(Request $request)
    {
        ini_set('memory_limit', '512M');
        set_time_limit(300); // Increase execution time as well
        $query = Aset::with(['jenisBarang.klasifikasi', 'ruangan.lokasi']);

        if ($request->filled('lokasi_id')) {
            $query->whereHas('ruangan', fn($q) => $q->where('lokasi_id', $request->lokasi_id));
        }
        if ($request->filled('ruangan_id')) {
            $query->where('ruangan_id', $request->ruangan_id);
        }
        if ($request->filled('klasifikasi_id')) {
            $query->whereHas('jenisBarang', fn($q) => $q->where('klasifikasi_id', $request->klasifikasi_id));
        }
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }
        if ($request->filled('tahun_pembelian')) {
            $query->where('tahun_pembelian', $request->tahun_pembelian);
        }

        $aset = $query->orderBy('kode_aset')->get();
        $selectedLokasi = $request->filled('lokasi_id') ? MasterLokasi::find($request->lokasi_id)?->nama_lokasi : null;
        $selectedRuangan = $request->filled('ruangan_id') ? MasterRuangan::find($request->ruangan_id)?->nama_ruangan : null;

        $pdf = Pdf::loadView('laporan.pdf', compact('aset', 'selectedLokasi', 'selectedRuangan'));
        $pdf->setPaper('a4', 'landscape');

        return $pdf->download('laporan-aset-' . date('Y-m-d') . '.pdf');
    }
}