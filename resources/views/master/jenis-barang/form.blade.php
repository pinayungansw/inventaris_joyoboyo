@extends('layouts.app')
@section('title', isset($jenisBarang) ? 'Edit Jenis Barang' : 'Tambah Jenis Barang')
@section('page-title', isset($jenisBarang) ? 'Edit Jenis Barang' : 'Tambah Jenis Barang')

@section('content')
<div class="max-w-lg">
    <div class="rounded-2xl bg-white p-8 shadow-sm border border-slate-200">
        <form
            action="{{ isset($jenisBarang) ? route('master.jenis-barang.update', $jenisBarang) : route('master.jenis-barang.store') }}"
            method="POST">
            @csrf
            @if(isset($jenisBarang)) @method('PUT') @endif

            <div class="space-y-6">
                {{-- Klasifikasi Selection --}}
                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Klasifikasi
                        <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="klasifikasi_id"
                            class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner"
                            required>
                            <option value="">Pilih Klasifikasi</option>
                            @foreach($klasifikasi as $k)
                            @php
                            $selected = false;
                            if(old('klasifikasi_id')) {
                            $selected = old('klasifikasi_id') == $k->id;
                            } elseif(isset($jenisBarang)) {
                            $selected = $jenisBarang->klasifikasi_id == $k->id;
                            }
                            @endphp
                            <option value="{{ $k->id }}" {{ $selected ? 'selected' : '' }}>
                                {{ ($k->kode_klasifikasi ? '[' . $k->kode_klasifikasi . '] ' : '') . $k->nama_klasifikasi }}
                            </option>
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
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Kode Jenis
                        <span class="text-red-500">*</span></label>
                    <input type="text" name="kode_jenis" value="{{ old('kode_jenis', $jenisBarang->kode_jenis ?? '') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner placeholder:text-slate-300"
                        placeholder="cth: MBL" required>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Nama Jenis
                        <span class="text-red-500">*</span></label>
                    <input type="text" name="nama_jenis" value="{{ old('nama_jenis', $jenisBarang->nama_jenis ?? '') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner placeholder:text-slate-300"
                        placeholder="cth: Mobil Penumpang" required>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="rounded-xl bg-[#004500] px-8 py-3 text-sm font-bold text-white shadow-sm hover:bg-[#003800] transition active:scale-[0.98]">
                        {{ isset($jenisBarang) ? 'Simpan Perubahan' : 'Tambah Jenis Barang' }}
                    </button>
                    <a href="{{ route('master.jenis-barang.index') }}"
                        class="rounded-xl bg-slate-100 px-8 py-3 text-sm font-bold text-slate-500 hover:bg-slate-200 transition border border-slate-200/50">
                        Batal
                    </a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection