<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\MutasiAset;
use App\Models\MasterRuangan;
use App\Models\MasterLokasi;
use Illuminate\Http\Request;

class MutasiAsetController extends Controller
{
    public function index(Request $request)
    {
        $query = MutasiAset::with(['aset.jenisBarang', 'dariRuangan.lokasi', 'keRuangan.lokasi']);

        if ($request->filled('start_date')) {
            $query->whereDate('tanggal_mutasi', '>=', $request->start_date);
        }

        if ($request->filled('end_date')) {
            $query->whereDate('tanggal_mutasi', '<=', $request->end_date);
        }

        $mutasi = $query->latest('tanggal_mutasi')->paginate(20)->withQueryString();

        return view('mutasi.index', compact('mutasi'));
    }

    public function create(Request $request)
    {
        $aset = null;
        if ($request->filled('aset_id')) {
            $aset = Aset::with('ruangan.lokasi')->findOrFail($request->aset_id);
        }

        $allAset = Aset::with(['jenisBarang', 'ruangan.lokasi'])->get();
        $ruangan = MasterRuangan::with('lokasi')->get();
        $lokasi = MasterLokasi::orderBy('nama_lokasi')->get();

        // Data siap pakai untuk JS (hindari arrow function di Blade @json)
        $asetData = $allAset->map(function ($a) {
            return [
                'id' => $a->id,
                'label' => $a->jenisBarang?->nama_jenis ?? 'Aset',
                'kode' => $a->nomor_seri_inventaris ?? '-',
                'ruangan_id' => $a->ruangan_id,
                'ruangan' => $a->ruangan?->nama_ruangan ?? '-',
                'lokasi_id' => $a->ruangan?->lokasi?->id,
                'lokasi' => $a->ruangan?->lokasi?->nama_lokasi ?? '-',
            ];
        })->values();

        $ruanganData = $ruangan->map(function ($r) {
            return [
                'id' => $r->id,
                'nama' => $r->nama_ruangan,
                'lokasi_id' => $r->lokasi_id,
            ];
        })->values();

        return view('mutasi.form', compact('aset', 'allAset', 'ruangan', 'lokasi', 'asetData', 'ruanganData'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'aset_id' => 'required|exists:aset,id',
            'ke_ruangan_id' => 'required|exists:master_ruangan,id',
            'tanggal_mutasi' => 'required|date',
            'keterangan' => 'nullable|string',
        ]);

        $aset = Aset::findOrFail($validated['aset_id']);

        // Can't transfer to the same room
        if ($aset->ruangan_id == $validated['ke_ruangan_id']) {
            return back()->withErrors(['ke_ruangan_id' => 'Ruangan tujuan tidak boleh sama dengan ruangan saat ini.'])->withInput();
        }

        $validated['dari_ruangan_id'] = $aset->ruangan_id;

        MutasiAset::create($validated);

        // Update aset location
        $aset->update(['ruangan_id' => $validated['ke_ruangan_id']]);

        return redirect()->route('mutasi.index')->with('success', 'Mutasi aset berhasil dicatat.');
    }
}