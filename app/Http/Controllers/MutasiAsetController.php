<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\MutasiAset;
use App\Models\MasterRuangan;
use Illuminate\Http\Request;

class MutasiAsetController extends Controller
{
    public function index()
    {
        $mutasi = MutasiAset::with(['aset.jenisBarang', 'dariRuangan.lokasi', 'keRuangan.lokasi'])
            ->latest('tanggal_mutasi')
            ->paginate(20);

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

        return view('mutasi.form', compact('aset', 'allAset', 'ruangan'));
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