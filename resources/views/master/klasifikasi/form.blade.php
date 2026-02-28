@extends('layouts.app')
@section('title', isset($klasifikasi) ? 'Edit Klasifikasi' : 'Tambah Klasifikasi')
@section('page-title', isset($klasifikasi) ? 'Edit Klasifikasi' : 'Tambah Klasifikasi')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl bg-white p-6 shadow-sm border border-[#E2E8F0]">
        <form
            action="{{ isset($klasifikasi) ? route('master.klasifikasi.update', $klasifikasi) : route('master.klasifikasi.store') }}"
            method="POST">
            @csrf
            @if(isset($klasifikasi)) @method('PUT') @endif
            <div class="space-y-6">
                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Nama
                        Klasifikasi <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_klasifikasi"
                        value="{{ old('nama_klasifikasi', $klasifikasi->nama_klasifikasi ?? '') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner placeholder:text-slate-300"
                        placeholder="cth: Peralatan Kantor" required>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="rounded-xl bg-[#004500] px-8 py-3 text-sm font-bold text-white shadow-sm hover:bg-[#003800] transition active:scale-[0.98]">
                        {{ isset($klasifikasi) ? 'Simpan Perubahan' : 'Tambah Klasifikasi' }}
                    </button>
                    <a href="{{ route('master.klasifikasi.index') }}"
                        class="rounded-xl bg-slate-100 px-8 py-3 text-sm font-bold text-slate-500 hover:bg-slate-200 transition border border-slate-200/50">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection