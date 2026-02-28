<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\MasterRuangan;
use App\Models\MasterJenisBarang;
use Illuminate\Http\Request;

class DropdownController extends Controller
{
    public function ruangan(Request $request)
    {
        $query = MasterRuangan::query();
        if ($request->filled('lokasi_id')) {
            $query->where('lokasi_id', $request->lokasi_id);
        }
        return response()->json($query->get());
    }

    public function jenisBarang(Request $request)
    {
        $query = MasterJenisBarang::query();
        if ($request->filled('klasifikasi_id')) {
            $query->where('klasifikasi_id', $request->klasifikasi_id);
        }
        return response()->json($query->get());
    }
}