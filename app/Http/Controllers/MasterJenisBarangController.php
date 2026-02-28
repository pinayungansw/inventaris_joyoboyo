<?php

namespace App\Http\Controllers;

use App\Models\MasterJenisBarang;
use App\Models\MasterKlasifikasi;
use Illuminate\Http\Request;

class MasterJenisBarangController extends Controller
{
    public function index(Request $request)
    {
        $query = MasterJenisBarang::with('klasifikasi')->withCount('aset');

        if ($request->filled('klasifikasi_id')) {
            $query->where('klasifikasi_id', $request->klasifikasi_id);
        }

        $jenisBarang = $query->get();
        $klasifikasi = MasterKlasifikasi::all();

        return view('master.jenis-barang.index', compact('jenisBarang', 'klasifikasi'));
    }

    public function create()
    {
        $klasifikasi = MasterKlasifikasi::all();
        return view('master.jenis-barang.form', compact('klasifikasi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'klasifikasi_id' => 'required|exists:master_klasifikasi,id',
            'kode_jenis' => 'required|string|max:50',
            'nama_jenis' => 'required|string|max:255',
        ]);

        MasterJenisBarang::create($request->only('klasifikasi_id', 'kode_jenis', 'nama_jenis'));
        return redirect()->route('master.jenis-barang.index')->with('success', 'Jenis Barang berhasil ditambahkan.');
    }

    public function edit(MasterJenisBarang $jenisBarang)
    {
        $klasifikasi = MasterKlasifikasi::all();
        return view('master.jenis-barang.form', compact('jenisBarang', 'klasifikasi'));
    }

    public function update(Request $request, MasterJenisBarang $jenisBarang)
    {
        $request->validate([
            'klasifikasi_id' => 'required|exists:master_klasifikasi,id',
            'kode_jenis' => 'required|string|max:50',
            'nama_jenis' => 'required|string|max:255',
        ]);

        $jenisBarang->update($request->only('klasifikasi_id', 'kode_jenis', 'nama_jenis'));
        return redirect()->route('master.jenis-barang.index')->with('success', 'Jenis Barang berhasil diperbarui.');
    }

    public function destroy(MasterJenisBarang $jenisBarang)
    {
        $jenisBarang->delete();
        return redirect()->route('master.jenis-barang.index')->with('success', 'Jenis Barang berhasil dihapus.');
    }
}