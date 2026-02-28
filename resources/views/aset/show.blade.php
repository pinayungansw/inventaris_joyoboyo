@extends('layouts.app')
@section('title', 'Detail Aset — ' . $aset->kode_aset)
@section('page-title', 'Detail Aset')

@section('content')
    <div class="space-y-6">
        {{-- Header --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between gap-4">
            <div>
                <h3 class="text-xl font-bold text-slate-800 tracking-tight">{{ $aset->nomor_seri_inventaris ?? '-' }}</h3>
                <p class="text-xs font-bold text-slate-400 uppercase tracking-widest">{{
        $aset->jenisBarang?->klasifikasi?->nama_klasifikasi }} — {{
        $aset->jenisBarang?->nama_jenis }}</p>
            </div>
            <div class="flex items-center gap-2">
                <a href="{{ route('mutasi.create', ['aset_id' => $aset->id]) }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-slate-100 px-4 py-2.5 text-sm font-medium text-slate-600 hover:bg-slate-200 transition border border-slate-200/50">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M8 7h12m0 0l-4-4m4 4l-4 4m0 6H4m0 0l4 4m-4-4l4-4" />
                    </svg>
                    Mutasi
                </a>
                <a href="{{ route('aset.edit', $aset) }}"
                    class="inline-flex items-center gap-2 rounded-xl bg-[#004500] px-4 py-2.5 text-sm font-medium text-white hover:bg-[#003800] transition shadow-sm">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit Aset
                </a>
            </div>
        </div>

        {{-- Detail Card --}}
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-slate-200">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">NOMOR SERI INVENTARIS</p>
                    <p class="mt-1 text-sm font-mono font-bold text-[#1C7791]">{{ $aset->nomor_seri_inventaris ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Klasifikasi</p>
                    <p class="mt-1 text-sm font-medium text-slate-700">{{
        $aset->jenisBarang?->klasifikasi?->nama_klasifikasi ?? '-' }}
                    </p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jenis Barang</p>
                    <p class="mt-1 text-sm font-medium text-slate-700">{{ $aset->jenisBarang?->nama_jenis ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Lokasi</p>
                    <p class="mt-1 text-sm font-medium text-slate-700">{{ $aset->ruangan?->lokasi?->nama_lokasi ?? '-' }}
                    </p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Ruangan</p>
                    <p class="mt-1 text-sm font-medium text-slate-700">{{ $aset->ruangan?->nama_ruangan ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Merk</p>
                    <p class="mt-1 text-sm font-medium text-slate-700">{{ $aset->merk ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Spesifikasi</p>
                    <p class="mt-1 text-sm font-medium text-slate-700">{{ $aset->spesifikasi ?? '-' }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Tahun Pembelian</p>
                    <p class="mt-1 text-sm font-medium text-slate-700">{{ $aset->tahun_pembelian }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kondisi</p>
                    <div class="mt-1">
                        @if($aset->kondisi === 'Baik')
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[10px] font-bold uppercase bg-emerald-50 text-emerald-600 border border-emerald-100">Baik</span>
                        @elseif($aset->kondisi === 'Layak')
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[10px] font-bold uppercase bg-amber-50 text-amber-600 border border-amber-100">Layak</span>
                        @elseif($aset->kondisi === 'Rusak')
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[10px] font-bold uppercase bg-red-50 text-red-600 border border-red-100">Rusak</span>
                        @else
                            <span
                                class="inline-flex items-center px-2.5 py-0.5 rounded-lg text-[10px] font-bold uppercase bg-slate-50 text-slate-600 border border-slate-100">Expired</span>
                        @endif
                    </div>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Jumlah</p>
                    <p class="mt-1 text-sm font-bold text-slate-700">{{ $aset->jumlah }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Kode Sistem</p>
                    <p class="mt-1 text-sm font-medium text-slate-700">{{ $aset->kode_aset }}</p>
                </div>
                <div>
                    <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">Keterangan</p>
                    <p class="mt-1 text-sm text-slate-600 font-medium">{{ $aset->keterangan ?? '-' }}</p>
                </div>
            </div>
        </div>

        {{-- Mutation History --}}
        <div class="rounded-2xl bg-white shadow-sm border border-slate-200 overflow-hidden">
            <div class="px-6 py-4 border-b border-slate-100">
                <h3 class="text-sm font-bold text-slate-700">Riwayat Mutasi</h3>
            </div>
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-50 text-slate-500 border-b border-slate-100">
                            <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Tanggal</th>
                            <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Dari</th>
                            <th class="px-6 py-4 text-center font-medium uppercase tracking-wider text-[10px] w-12">→</th>
                            <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Ke</th>
                            <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Keterangan</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-100">
                        @forelse($aset->mutasi->sortByDesc('tanggal_mutasi') as $m)
                                        <tr class="hover:bg-slate-50/50 transition-colors">
                                            <td class="px-6 py-4 font-bold text-slate-400 text-xs tracking-tight">{{
                            $m->tanggal_mutasi->format('d/m/Y') }}</td>
                                            <td class="px-6 py-4">
                                                <p class="text-[10px] font-bold text-slate-700 uppercase">{{ $m->dariRuangan?->nama_ruangan
                                                                        }}</p>
                                                <p class="text-[9px] font-bold text-slate-400 uppercase">{{
                            $m->dariRuangan?->lokasi?->nama_lokasi }}</p>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div
                                                    class="w-6 h-6 rounded-full bg-slate-100 flex items-center justify-center text-slate-400 mx-auto">
                                                    <svg class="w-3 h-3" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                            d="M14 5l7 7m0 0l-7 7m7-7H3" />
                                                    </svg>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="text-[10px] font-bold text-[#1C7791] uppercase">{{ $m->keRuangan?->nama_ruangan }}
                                                </p>
                                                <p class="text-[9px] font-bold text-slate-400 uppercase">{{
                            $m->keRuangan?->lokasi?->nama_lokasi }}</p>
                                            </td>
                                            <td class="px-6 py-4 text-slate-600 font-medium text-xs">{{ $m->keterangan ?? '-' }}</td>
                                        </tr>
                        @empty
                            <tr>
                                <td colspan="5" class="px-6 py-12 text-center">
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