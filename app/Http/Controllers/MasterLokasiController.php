<?php

namespace App\Http\Controllers;

use App\Models\MasterLokasi;
use Illuminate\Http\Request;

class MasterLokasiController extends Controller
{
    public function index()
    {
        $lokasi = MasterLokasi::withCount('ruangan')->get();
        return view('master.lokasi.index', compact('lokasi'));
    }

    public function create()
    {
        return view('master.lokasi.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_lokasi' => 'required|string|max:50|unique:master_lokasi,kode_lokasi',
            'nama_lokasi' => 'required|string|max:255'
        ]);
        MasterLokasi::create($request->only('kode_lokasi', 'nama_lokasi'));
        return redirect()->route('master.lokasi.index')->with('success', 'Lokasi berhasil ditambahkan.');
    }

    public function edit(MasterLokasi $lokasi)
    {
        return view('master.lokasi.form', compact('lokasi'));
    }

    public function update(Request $request, MasterLokasi $lokasi)
    {
        $request->validate([
            'kode_lokasi' => 'required|string|max:50|unique:master_lokasi,kode_lokasi,' . $lokasi->id,
            'nama_lokasi' => 'required|string|max:255'
        ]);
        $lokasi->update($request->only('kode_lokasi', 'nama_lokasi'));
        return redirect()->route('master.lokasi.index')->with('success', 'Lokasi berhasil diperbarui.');
    }

    public function destroy(MasterLokasi $lokasi)
    {
        $lokasi->delete();
        return redirect()->route('master.lokasi.index')->with('success', 'Lokasi berhasil dihapus.');
    }
}