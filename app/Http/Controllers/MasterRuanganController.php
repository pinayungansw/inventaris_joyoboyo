<?php

namespace App\Http\Controllers;

use App\Models\MasterRuangan;
use App\Models\MasterLokasi;
use Illuminate\Http\Request;

class MasterRuanganController extends Controller
{
    public function index(Request $request)
    {
        $query = MasterRuangan::with('lokasi')->withCount('aset');

        if ($request->filled('lokasi_id')) {
            $query->where('lokasi_id', $request->lokasi_id);
        }

        $ruangan = $query->get();
        $lokasi = MasterLokasi::all();

        return view('master.ruangan.index', compact('ruangan', 'lokasi'));
    }

    public function create()
    {
        $lokasi = MasterLokasi::all();
        return view('master.ruangan.form', compact('lokasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'lokasi_id' => 'required|exists:master_lokasi,id',
            'kode_ruangan' => 'required|string|max:50',
            'nama_ruangan' => 'required|string|max:255',
        ]);

        MasterRuangan::create($request->only('lokasi_id', 'kode_ruangan', 'nama_ruangan'));
        return redirect()->route('master.ruangan.index')->with('success', 'Ruangan berhasil ditambahkan.');
    }

    public function edit(MasterRuangan $ruangan)
    {
        $lokasi = MasterLokasi::all();
        return view('master.ruangan.form', compact('ruangan', 'lokasi'));
    }

    public function update(Request $request, MasterRuangan $ruangan)
    {
        $request->validate([
            'lokasi_id' => 'required|exists:master_lokasi,id',
            'kode_ruangan' => 'required|string|max:50',
            'nama_ruangan' => 'required|string|max:255',
        ]);

        $ruangan->update($request->only('lokasi_id', 'kode_ruangan', 'nama_ruangan'));
        return redirect()->route('master.ruangan.index')->with('success', 'Ruangan berhasil diperbarui.');
    }

    public function destroy(MasterRuangan $ruangan)
    {
        $ruangan->delete();
        return redirect()->route('master.ruangan.index')->with('success', 'Ruangan berhasil dihapus.');
    }
}