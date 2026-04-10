@extends('layouts.app')
@section('title', isset($lokasi) ? 'Edit Lokasi' : 'Tambah Lokasi')
@section('page-title', isset($lokasi) ? 'Edit Lokasi' : 'Tambah Lokasi')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl bg-white p-6 shadow-sm border border-[#E2E8F0]">
        <form action="{{ isset($lokasi) ? route('master.lokasi.update', $lokasi) : route('master.lokasi.store') }}"
            method="POST">
            @csrf
            @if(isset($lokasi)) @method('PUT') @endif

            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Kode Lokasi</label>
                <input type="text" name="kode_lokasi" value="{{ old('kode_lokasi', $lokasi->kode_lokasi ?? '') }}"
                    class="w-full form-control transition" placeholder="cth: 01" required>
            </div>

            <div class="mb-5">
                <label class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lokasi</label>
                <input type="text" name="nama_lokasi" value="{{ old('nama_lokasi', $lokasi->nama_lokasi ?? '') }}"
                    class="w-full form-control transition" required>
            </div>

            <div class="flex items-center gap-3 mt-6">
                <button type="submit"
                    class="rounded-xl bg-[#004500] px-6 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-[#003800] transition active:scale-[0.98]">
                    {{ isset($lokasi) ? 'Simpan Perubahan' : 'Tambah Lokasi' }}
                </button>
                <a href="{{ route('master.lokasi.index') }}"
                    class="rounded-xl bg-slate-100 px-6 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-200 transition border border-slate-200/50">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection