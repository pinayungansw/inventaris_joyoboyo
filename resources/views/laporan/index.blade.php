@extends('layouts.app')
@section('title', 'Laporan & Export')
@section('page-title', 'Laporan & Export')

@section('content')
    <div class="space-y-6">
        {{-- Filters --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
            <form method="GET">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-5 gap-6">
                    <div class="space-y-1.5">
                        <label
                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Lokasi</label>
                        <div class="relative">
                            <select name="lokasi_id"
                                class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner">
                                <option value="">Semua Lokasi</option>
                                @foreach($lokasi as $l)
                                                        <option value="{{ $l->id }}" {{ request('lokasi_id') == $l->id ? 'selected' : '' }}>{{
                                    $l->nama_lokasi }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label
                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Ruangan</label>
                        <div class="relative">
                            <select name="ruangan_id"
                                class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner">
                                <option value="">Semua Ruangan</option>
                                @foreach($ruangan as $r)
                                                        <option value="{{ $r->id }}" {{ request('ruangan_id') == $r->id ? 'selected' : '' }}>{{
                                    $r->lokasi->nama_lokasi }} — {{ $r->nama_ruangan }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label
                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Klasifikasi</label>
                        <div class="relative">
                            <select name="klasifikasi_id"
                                class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner">
                                <option value="">Semua</option>
                                @foreach($klasifikasi as $k)
                                                        <option value="{{ $k->id }}" {{ request('klasifikasi_id') == $k->id ? 'selected' : '' }}>{{
                                    $k->nama_klasifikasi }}</option>
                                @endforeach
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label
                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Kondisi</label>
                        <div class="relative">
                            <select name="kondisi"
                                class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner">
                                <option value="">Semua Kondisi</option>
                                <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Layak" {{ request('kondisi') == 'Layak' ? 'selected' : '' }}>Layak</option>
                                <option value="Rusak" {{ request('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Tahun
                            Perolehan</label>
                        <input type="number" name="tahun_pembelian" value="{{ request('tahun_pembelian') }}"
                            placeholder="cth: 2024"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner placeholder:text-slate-300">
                    </div>
                    <div class="lg:col-span-3 flex items-end gap-3 mt-2">
                        <button type="submit"
                            class="rounded-xl bg-[#004500] px-8 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-[#003800] transition">
                            Filter Laporan
                        </button>
                        <a href="{{ route('laporan.index') }}"
                            class="rounded-xl bg-slate-100 px-6 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-200 transition border border-slate-200/50">
                            Reset
                        </a>
                    </div>
                    <div class="lg:col-span-2 flex items-end justify-end gap-2 mt-2">
                        <a href="{{ route('laporan.export.excel', request()->all()) }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-emerald-50 px-5 py-2.5 text-sm font-bold text-emerald-700 hover:bg-emerald-100 transition border border-emerald-100 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            Export Excel
                        </a>
                        <a href="{{ route('laporan.export.pdf', request()->all()) }}"
                            class="inline-flex items-center gap-2 rounded-xl bg-red-50 px-5 py-2.5 text-sm font-bold text-red-700 hover:bg-red-100 transition border border-red-100 shadow-sm">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            PDF
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Results Table --}}
        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
                <h3 class="text-sm font-bold text-slate-700">Daftar Inventaris Terpilih <span
                        class="ml-2 text-[#1C7791] font-bold italic">{{ $aset->count() }} Item</span></h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 border-b border-slate-100">
                            <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">NOMOR SERI
                                INVENTARIS</th>
                            <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Aset &
                                Klasifikasi</th>
                            <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Lokasi</th>
                            <th class="px-6 py-4 text-center font-medium uppercase tracking-wider text-[10px]">Kondisi</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($aset as $a)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-6 py-4 font-mono text-xs font-bold text-[#1C7791]">{{ $a->nomor_seri_inventaris ?? '-' }}</td>
                                            <td class="px-6 py-4">
                                                <p class="font-bold text-slate-700">{{ $a->jenisBarang?->nama_jenis }}</p>
                                                <p class="text-[10px] font-bold text-slate-400">{{
                            $a->jenisBarang?->klasifikasi?->nama_klasifikasi }}</p>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="text-[10px] font-bold text-slate-700 uppercase">{{ $a->ruangan?->nama_ruangan }}
                                                </p>
                                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-tight">{{
                            $a->ruangan?->lokasi?->nama_lokasi }}</p>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if($a->kondisi === 'Baik')
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-bold uppercase bg-emerald-50 text-emerald-600 border border-emerald-100">Baik</span>
                                                @elseif($a->kondisi === 'Layak')
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-bold uppercase bg-amber-50 text-amber-600 border border-amber-100">Layak</span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-2 py-0.5 rounded-lg text-[10px] font-bold uppercase bg-red-50 text-red-600 border border-red-100">Rusak</span>
                                                @endif
                                            </td>
                                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center text-slate-400 italic">Tidak ada data aset
                                    ditemukan untuk filter terpilih.</td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection