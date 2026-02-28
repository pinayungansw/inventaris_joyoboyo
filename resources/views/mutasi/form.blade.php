@extends('layouts.app')
@section('title', 'Mutasi Aset Baru')
@section('page-title', 'Mutasi Aset Baru')

@section('content')
<div class="max-w-xl">
    <div class="rounded-2xl bg-white p-8 shadow-sm border border-slate-200">
        <form action="{{ route('mutasi.store') }}" method="POST">
            @csrf

            <div class="space-y-6">
                {{-- Aset Selection --}}
                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Pilih Aset
                        <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="aset_id"
                            class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner"
                            required>
                            <option value="">Pilih Aset untuk Dimutasi</option>
                            @foreach($allAset as $a)
                            <option value="{{ $a->id }}" {{ (old('aset_id', $aset?->id ?? '') == $a->id) ? 'selected' :
                                '' }}>
                                [{{ $a->kode_aset }}] {{ $a->jenisBarang?->nama_jenis }} — {{
                                $a->ruangan?->lokasi?->nama_lokasi }}/{{ $a->ruangan?->nama_ruangan }}
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

                @if($aset)
                <div class="p-4 rounded-xl bg-[#1C7791]/5 border border-[#1C7791]/10 flex items-start gap-3">
                    <div
                        class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-[#1C7791] shadow-sm flex-shrink-0">
                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>
                    </div>
                    <div>
                        <p class="text-[10px] font-bold text-[#1C7791] uppercase tracking-wider">Lokasi Saat Ini</p>
                        <p class="text-sm font-bold text-slate-700">{{ $aset->ruangan?->lokasi?->nama_lokasi }} — {{
                            $aset->ruangan?->nama_ruangan }}</p>
                    </div>
                </div>
                @endif

                {{-- Ruangan Tujuan --}}
                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Ruangan
                        Tujuan <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="ke_ruangan_id"
                            class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner"
                            required>
                            <option value="">Pilih Ruangan Tujuan</option>
                            @foreach($ruangan as $r)
                            <option value="{{ $r->id }}" {{ old('ke_ruangan_id')==$r->id ? 'selected' : '' }}>
                                {{ $r->lokasi->nama_lokasi }} — {{ $r->nama_ruangan }}
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

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-5">
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Tanggal
                            Mutasi <span class="text-red-500">*</span></label>
                        <input type="date" name="tanggal_mutasi" value="{{ old('tanggal_mutasi', date('Y-m-d')) }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner"
                            required>
                    </div>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Keterangan
                        / Alasan</label>
                    <textarea name="keterangan" rows="3"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner placeholder:text-slate-300"
                        placeholder="cth: Pemindahan unit ke kantor baru atau perbaikan">{{ old('keterangan') }}</textarea>
                </div>

                <div class="flex items-center gap-3 pt-2">
                    <button type="submit"
                        class="rounded-xl bg-[#004500] px-6 py-3 text-sm font-bold text-white hover:bg-[#003800] transition shadow-sm">
                        Proses Mutasi Aset
                    </button>
                    <a href="{{ route('mutasi.index') }}"
                        class="rounded-xl bg-slate-100 px-6 py-3 text-sm font-bold text-slate-500 hover:bg-slate-200 transition border border-slate-200/50">Batal</a>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection