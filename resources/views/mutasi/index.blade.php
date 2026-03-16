@extends('layouts.app')
@section('title', 'Riwayat Mutasi')
@section('page-title', 'Riwayat Mutasi Barang')

@section('content')
    <div class="space-y-6">
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <p class="text-sm text-slate-500 font-medium">Log pemindahan aset antar ruangan perumda</p>
            <a href="{{ route('mutasi.create') }}"
                class="inline-flex items-center gap-2 rounded-xl bg-[#004500] px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-[#003800] transition">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
                </svg>
                Tambah Mutasi
            </a>
        </div>

        {{-- Filter Section --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
            <form method="GET" action="{{ route('mutasi.index') }}">
                <div class="flex flex-wrap items-end gap-4">
                    <div class="space-y-1.5 flex-1 min-w-[200px]">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Dari Tanggal</label>
                        <input type="date" name="start_date" value="{{ request('start_date') }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner">
                    </div>
                    <div class="space-y-1.5 flex-1 min-w-[200px]">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Sampai Tanggal</label>
                        <input type="date" name="end_date" value="{{ request('end_date') }}"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner">
                    </div>
                    <div class="flex gap-2">
                        <button type="submit"
                            class="rounded-xl bg-[#1C7791] px-6 py-2.5 text-sm font-bold text-white shadow-sm hover:brightness-110 transition active:scale-95">
                            Filter
                        </button>
                        <a href="{{ route('mutasi.index') }}"
                            class="rounded-xl bg-slate-100 px-6 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-200 transition border border-slate-200/50 text-center">
                            Reset
                        </a>
                    </div>
                </div>
            </form>
        </div>

        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 border-b border-slate-100">
                            <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Tanggal</th>
                            <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Aset & Barang
                            </th>
                            <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Pergerakan
                                Lokasi</th>
                            <th class="px-6 py-4 text-center font-medium uppercase tracking-wider text-[10px] w-12"></th>
                            <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Tujuan</th>
                            <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($mutasi as $m)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-6 py-4 font-bold text-slate-400 text-xs uppercase">
                                                {{ $m->tanggal_mutasi->format('d/m/Y') }}
                                            </td>
                                            <td class="px-6 py-4">
                                                <a href="{{ route('aset.show', $m->aset) }}" class="group block">
                                                    <p
                                                        class="text-xs font-mono font-bold text-[#1C7791] tracking-wider group-hover:underline">
                                                        {{ $m->aset?->nomor_seri_inventaris ?? '-' }}
                                                    </p>
                                                    <p class="text-[10px] font-bold text-slate-500 uppercase tracking-tight">{{
                            $m->aset?->jenisBarang?->nama_jenis }}</p>
                                                </a>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="text-[10px] font-bold text-slate-700 uppercase tracking-tight">{{
                            $m->dariRuangan?->nama_ruangan }}</p>
                                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{
                            $m->dariRuangan?->lokasi?->nama_lokasi }}</p>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div
                                                    class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-slate-400">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                    </svg>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="text-[10px] font-bold text-[#1C7791] uppercase tracking-tight">{{
                            $m->keRuangan?->nama_ruangan }}</p>
                                                <p class="text-[9px] font-bold text-slate-400 uppercase tracking-widest">{{
                            $m->keRuangan?->lokasi?->nama_lokasi }}</p>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="text-xs text-slate-600 font-medium">{{ $m->keterangan ?? '-' }}</p>
                                            </td>
                                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center">
                                    <p class="text-slate-400 font-bold italic">Belum ada riwayat mutasi.</p>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection