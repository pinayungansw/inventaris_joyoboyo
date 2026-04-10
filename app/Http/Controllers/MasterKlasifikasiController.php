<?php

namespace App\Http\Controllers;

use App\Models\MasterKlasifikasi;
use Illuminate\Http\Request;

class MasterKlasifikasiController extends Controller
{
    public function index()
    {
        $klasifikasi = MasterKlasifikasi::withCount('jenisBarang')->get();
        return view('master.klasifikasi.index', compact('klasifikasi'));
    }

    public function create()
    {
        return view('master.klasifikasi.form');
    }

    public function store(Request $request)
    {
        $request->validate([
            'kode_klasifikasi' => 'nullable|string|max:50|unique:master_klasifikasi,kode_klasifikasi',
            'nama_klasifikasi' => 'required|string|max:255'
        ]);
        MasterKlasifikasi::create($request->only('kode_klasifikasi', 'nama_klasifikasi'));
        return redirect()->route('master.klasifikasi.index')->with('success', 'Klasifikasi berhasil ditambahkan.');
    }

    public function edit(MasterKlasifikasi $klasifikasi)
    {
        return view('master.klasifikasi.form', compact('klasifikasi'));
    }

    public function update(Request $request, MasterKlasifikasi $klasifikasi)
    {
        $request->validate([
            'kode_klasifikasi' => 'nullable|string|max:50|unique:master_klasifikasi,kode_klasifikasi,' . $klasifikasi->id,
            'nama_klasifikasi' => 'required|string|max:255'
        ]);
        $klasifikasi->update($request->only('kode_klasifikasi', 'nama_klasifikasi'));
        return redirect()->route('master.klasifikasi.index')->with('success', 'Klasifikasi berhasil diperbarui.');
    }

    public function destroy(MasterKlasifikasi $klasifikasi)
    {
        $klasifikasi->delete();
        return redirect()->route('master.klasifikasi.index')->with('success', 'Klasifikasi berhasil dihapus.');
    }
}