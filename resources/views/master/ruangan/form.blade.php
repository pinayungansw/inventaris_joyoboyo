@extends('layouts.app')
@section('title', isset($ruangan) ? 'Edit Ruangan' : 'Tambah Ruangan')
@section('page-title', isset($ruangan) ? 'Edit Ruangan' : 'Tambah Ruangan')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl bg-white p-8 shadow-sm border border-slate-200">
        <form action="{{ isset($ruangan) ? route('master.ruangan.update', $ruangan) : route('master.ruangan.store') }}"
            method="POST">
            @csrf
            @if(isset($ruangan)) @method('PUT') @endif

            <div class="space-y-6">
                {{-- Lokasi Selection --}}
                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Lokasi
                        Utama <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="lokasi_id"
                            class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner"
                            required>
                            <option value="">Pilih Lokasi</option>
                            @foreach($lokasi as $l)
                            <option value="{{ $l->id }}" {{ old('lokasi_id', $ruangan->lokasi_id ?? '') == $l->id ?
                                'selected' :
                                '' }}>{{ $l->nama_lokasi }}</option>
                            @endforeach
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Kode
                        Ruangan <span class="text-red-500">*</span></label>
                    <input type="text" name="kode_ruangan"
                        value="{{ old('kode_ruangan', $ruangan->kode_ruangan ?? '') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner placeholder:text-slate-300"
                        placeholder="cth: R-01" required>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Nama
                        Ruangan <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_ruangan"
                        value="{{ old('nama_ruangan', $ruangan->nama_ruangan ?? '') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner placeholder:text-slate-300"
                        placeholder="cth: Ruang Direksi" required>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="rounded-xl bg-[#004500] px-8 py-3 text-sm font-bold text-white shadow-sm hover:bg-[#003800] transition active:scale-[0.98]">
                        {{ isset($ruangan) ? 'Simpan Perubahan' : 'Tambah Ruangan' }}
                    </button>
                    <a href="{{ route('master.ruangan.index') }}"
                        class="rounded-xl bg-slate-100 px-8 py-3 text-sm font-bold text-slate-500 hover:bg-slate-200 transition border border-slate-200/50">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection