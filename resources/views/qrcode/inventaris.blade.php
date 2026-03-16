@extends('layouts.public')
@section('title', 'Inventaris — ' . $ruangan->nama_ruangan)

@section('content')
    <div class="space-y-6">
        {{-- Glass Header / Kop Surat --}}
        <div
            class="p-6 rounded-3xl shadow-xl border border-white/40 bg-white/70 backdrop-blur-xl text-center sm:text-left relative overflow-hidden glass-card">
            <div class="absolute top-0 left-0 w-1.5 h-full bg-[#004500]"></div>
            <div class="flex flex-col sm:flex-row items-center gap-6">
                <div class="shrink-0 bg-white p-2 rounded-2xl shadow-sm border border-slate-100">
                    <img src="{{ asset('perumda.png') }}" alt="Logo Perumda" class="h-14 w-auto object-contain">
                </div>
                <div class="flex-1 space-y-1">
                    <h2 class="text-xl font-black text-slate-900 tracking-tighter uppercase leading-tight">PERUMDA PASAR
                        JOYOBOYO</h2>
                    <p class="text-[10px] font-black text-[#1C7791] tracking-[0.3em] uppercase opacity-80">Kota Kediri —
                        Jawa Timur</p>
                    <div class="pt-3 flex flex-col gap-y-1.5 text-[10px] text-slate-500 font-bold uppercase tracking-wide">
                        <div class="flex items-start gap-1.5">
                            <svg class="w-3.5 h-3.5 mt-0.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M17.657 16.657L13.414 20.9a1.998 1.998 0 01-2.827 0l-4.244-4.243a8 8 0 1111.314 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M15 11a3 3 0 11-6 0 3 3 0 016 0z" />
                            </svg>
                            <span>Jl. Brigadir Jenderal Polisi Imam Bahri No. 92, Kelurahan Bangsal Kecamatan Pesantren Kota
                                Kediri</span>
                        </div>
                        <div class="flex flex-wrap gap-x-5 gap-y-1.5">
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z" />
                                </svg>
                                (0354) 671212
                            </span>
                            <span class="flex items-center gap-1.5">
                                <svg class="w-3.5 h-3.5 shrink-0" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z" />
                                </svg>
                                pasarjoyoboyokotakediri@gmail.com
                            </span>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Room Card --}}
        <div class="flex flex-col sm:flex-row items-start sm:items-end justify-between gap-4 px-2">
            <div class="space-y-1">
                <span
                    class="text-[9px] font-black text-slate-400 uppercase tracking-widest bg-white/50 px-2.5 py-1 rounded-lg border border-white/50">Lokasi
                    Ruangan</span>
                <h3 class="text-3xl font-black text-slate-900 tracking-tighter">{{ $ruangan->nama_ruangan }}</h3>
                <p class="text-[11px] font-black text-[#1C7791] uppercase tracking-[0.15em] opacity-80">{{
        $ruangan->lokasi?->nama_lokasi }}
                </p>
            </div>
            <div class="p-3 bg-white/70 backdrop-blur-lg rounded-2xl shadow-lg border border-white/50 text-[#1C7791]">
                <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01" />
                </svg>
            </div>
        </div>

        {{-- Summary Cards (Dashboard) --}}
        @if($rekapAset->count() > 0)
            <div class="grid grid-cols-2 sm:grid-cols-3 lg:grid-cols-4 gap-4 px-1">
                @foreach($rekapAset as $item)
                    <div class="bg-white/70 backdrop-blur-md p-4 rounded-2xl border border-white/40 shadow-sm glass-card">
                        <p class="text-[10px] font-black text-slate-400 uppercase tracking-widest leading-tight mb-1">
                            {{ $item['nama'] }}
                        </p>
                        <div class="flex items-baseline gap-1">
                            <span class="text-2xl font-black text-slate-800 tracking-tighter">{{ $item['total'] }}</span>
                            <span class="text-[10px] font-bold text-slate-400 uppercase tracking-wide">Unit</span>
                        </div>
                    </div>
                @endforeach
            </div>
        @endif

        {{-- Asset Table --}}
        <div class="rounded-3xl shadow-2xl border border-white/40 bg-white/60 backdrop-blur-xl overflow-hidden glass-card">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-900/90 text-white backdrop-blur-md">
                            <th class="px-6 py-4 text-left font-black uppercase tracking-widest text-[10px]">Identitas Aset
                            </th>
                            <th
                                class="px-6 py-4 text-left font-black uppercase tracking-widest text-[10px] hidden sm:table-cell">
                                Spesifikasi</th>
                            <th class="px-6 py-4 text-center font-black uppercase tracking-widest text-[10px] w-20">Qty</th>
                            <th class="px-6 py-4 text-center font-black uppercase tracking-widest text-[10px] w-28">Kondisi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-white/20">
                        @forelse($aset as $i => $a)
                                        <tr class="hover:bg-white/40 transition-colors group">
                                            <td class="px-6 py-4">
                                                <p
                                                    class="font-mono text-[9px] font-black text-slate-400 uppercase tracking-tighter mb-1 opacity-70 group-hover:opacity-100 transition-opacity">
                                                    {{ $a->nomor_seri_inventaris }}
                                                </p>
                                                <p class="font-black text-slate-800 leading-tight text-sm tracking-tight">{{
                            $a->jenisBarang?->nama_jenis }}
                                                </p>
                                                <span class="text-[9px] text-[#1C7791] font-black uppercase tracking-wider opacity-80">{{
                            $a->jenisBarang?->klasifikasi?->nama_klasifikasi }}</span>
                                            </td>
                                            <td class="px-6 py-4 hidden sm:table-cell">
                                                <div class="space-y-1 text-xs">
                                                    <p class="text-slate-600 font-bold"><span
                                                            class="text-slate-400 font-medium tracking-tight">Merk:</span> {{ $a->merk ??
                            '-' }}</p>
                                                    <p class="text-slate-600 font-bold"><span
                                                            class="text-slate-400 font-medium tracking-tight">Tahun:</span> {{
                            $a->tahun_pembelian }}</p>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span
                                                    class="inline-flex items-center justify-center min-w-[2rem] h-8 rounded-xl bg-white/50 font-black text-slate-700 shadow-inner border border-white/50">{{
                            $a->jumlah }}</span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if($a->kondisi === 'Baik')
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-xl text-[9px] font-black uppercase bg-emerald-500/10 text-emerald-600 border border-emerald-500/20 backdrop-blur-sm">Baik</span>
                                                @elseif($a->kondisi === 'Layak')
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-xl text-[9px] font-black uppercase bg-amber-500/10 text-amber-600 border border-amber-500/20 backdrop-blur-sm">Layak</span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-xl text-[9px] font-black uppercase bg-red-500/10 text-red-600 border border-red-500/20 backdrop-blur-sm">Rusak</span>
                                                @endif
                                            </td>
                                        </tr>
                        @empty
                            <tr>
                                <td colspan="4" class="px-6 py-12 text-center">
                                    <div class="flex flex-col items-center gap-3 opacity-40">
                                        <svg class="w-12 h-12" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5"
                                                d="M20 13V6a2 2 0 00-2-2H6a2 2 0 00-2 2v7m16 0v5a2 2 0 01-2 2H6a2 2 0 01-2-2v-5m16 0h-2.586a1 1 0 00-.707.293l-2.414 2.414a1 1 0 01-.707.293h-3.172a1 1 0 01-.707-.293l-2.414-2.414A1 1 0 006.586 13H4" />
                                        </svg>
                                        <p class="text-xs font-black uppercase tracking-widest text-slate-500">Belum ada aset di
                                            ruangan ini</p>
                                    </div>
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>

            @if(isset($aset) && $aset->hasPages())
                <div class="px-6 py-4 bg-slate-100/50 backdrop-blur-lg border-t border-white/20">
                    <div class="flex justify-end">
                        {{ $aset->links() }}
                    </div>
                </div>
            @endif
        </div>
    </div>
@endsection