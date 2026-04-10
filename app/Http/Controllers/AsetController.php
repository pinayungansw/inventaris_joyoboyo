<?php

namespace App\Http\Controllers;

use App\Models\Aset;
use App\Models\MasterLokasi;
use App\Models\MasterKlasifikasi;
use App\Models\MasterJenisBarang;
use App\Models\MasterRuangan;
use Illuminate\Http\Request;

class AsetController extends Controller
{
    public function index(Request $request)
    {
        $query = Aset::with(['jenisBarang.klasifikasi', 'ruangan.lokasi']);

        // Search
        if ($request->filled('search')) {
            $search = $request->search;
            $query->where(function ($q) use ($search) {
                $q->where('kode_aset', 'like', "%{$search}%")
                    ->orWhere('nomor_seri_inventaris', 'like', "%{$search}%")
                    ->orWhere('merk', 'like', "%{$search}%")
                    ->orWhere('spesifikasi', 'like', "%{$search}%");
            });
        }

        // Filter by lokasi
        if ($request->filled('lokasi_id')) {
            $query->whereHas('ruangan', fn($q) => $q->where('lokasi_id', $request->lokasi_id));
        }

        // Filter by ruangan
        if ($request->filled('ruangan_id')) {
            $query->where('ruangan_id', $request->ruangan_id);
        }

        // Filter by klasifikasi
        if ($request->filled('klasifikasi_id')) {
            $query->whereHas('jenisBarang', fn($q) => $q->where('klasifikasi_id', $request->klasifikasi_id));
        }

        // Filter by kondisi
        if ($request->filled('kondisi')) {
            $query->where('kondisi', $request->kondisi);
        }

        // Filter by tahun
        if ($request->filled('tahun_pembelian')) {
            $query->where('tahun_pembelian', $request->tahun_pembelian);
        }

        $aset = $query->latest()->paginate(20)->withQueryString();

        $lokasi = MasterLokasi::all();
        $klasifikasi = MasterKlasifikasi::all();
        $ruangan = MasterRuangan::with('lokasi')->get();

        return view('aset.index', compact('aset', 'lokasi', 'klasifikasi', 'ruangan'));
    }

    public function create()
    {
        $lokasi = MasterLokasi::with('ruangan')->get();
        $klasifikasi = MasterKlasifikasi::with('jenisBarang')->get();
        return view('aset.form', compact('lokasi', 'klasifikasi'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'jenis_barang_id' => 'required|exists:master_jenis_barang,id',
            'ruangan_id' => 'required|exists:master_ruangan,id',
            'merk' => 'nullable|string|max:255',
            'spesifikasi' => 'nullable|string',
            'tahun_pembelian' => 'required|min:0|max:' . (date('Y') + 1),
            'kondisi' => 'required|in:Baik,Rusak,Layak,Expired',
            'jumlah' => 'required|integer|min:1',
            'nomor_seri_inventaris' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $validated['kode_aset'] = Aset::generateKodeAset(
            $validated['ruangan_id'],
            $validated['jenis_barang_id'],
            $validated['tahun_pembelian']
        );

        if (empty($validated['nomor_seri_inventaris'])) {
            $validated['nomor_seri_inventaris'] = Aset::generateNomorSeriInventaris(
                $validated['ruangan_id'],
                $validated['jenis_barang_id'],
                $validated['jumlah']
            );
        }

        Aset::create($validated);

        return redirect()->route('aset.index')->with('success', 'Aset berhasil ditambahkan dengan nomor seri inventaris: ' . $validated['nomor_seri_inventaris']);
    }

    public function show(Aset $aset)
    {
        $aset->load(['jenisBarang.klasifikasi', 'ruangan.lokasi', 'mutasi.dariRuangan.lokasi', 'mutasi.keRuangan.lokasi']);
        return view('aset.show', compact('aset'));
    }

    public function edit(Aset $aset)
    {
        $lokasi = MasterLokasi::with('ruangan')->get();
        $klasifikasi = MasterKlasifikasi::with('jenisBarang')->get();
        return view('aset.form', compact('aset', 'lokasi', 'klasifikasi'));
    }

    public function update(Request $request, Aset $aset)
    {
        $validated = $request->validate([
            'jenis_barang_id' => 'required|exists:master_jenis_barang,id',
            'ruangan_id' => 'required|exists:master_ruangan,id',
            'merk' => 'nullable|string|max:255',
            'spesifikasi' => 'nullable|string',
            'tahun_pembelian' => 'required|min:0|max:' . (date('Y') + 1),
            'kondisi' => 'required|in:Baik,Rusak,Layak,Expired',
            'jumlah' => 'required|integer|min:1',
            'nomor_seri_inventaris' => 'nullable|string|max:255',
            'keterangan' => 'nullable|string',
        ]);

        $aset->update($validated);

        return redirect()->route('aset.index')->with('success', 'Aset berhasil diperbarui.');
    }

    public function destroy(Aset $aset)
    {
        $aset->delete();
        return redirect()->route('aset.index')->with('success', 'Aset berhasil dihapus.');
    }
}