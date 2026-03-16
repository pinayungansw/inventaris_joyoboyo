@extends('layouts.app')
@section('title', 'Data Aset')
@section('page-title', 'Data Aset')

@section('content')
    <div class="space-y-6">
        {{-- Filters --}}
        <div class="bg-white rounded-2xl p-6 shadow-sm border border-slate-200">
            <form method="GET">
                <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-6">
                    <div class="space-y-1.5">
                        <label
                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Pencarian</label>
                        <input type="text" name="search" value="{{ request('search') }}"
                            placeholder="Nomor seri, merk, spesifikasi..."
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner placeholder:text-slate-300">
                    </div>
                    <div class="space-y-1.5">
                        <label
                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Lokasi</label>
                        <div class="relative">
                            <select name="lokasi_id"
                                class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner">
                                <option value="">Semua</option>
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
                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Klasifikasi</label>
                        <div class="relative">
                            <select name="klasifikasi_id"
                                class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner">
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
                                class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner">
                                <option value="">Semua</option>
                                <option value="Baik" {{ request('kondisi') == 'Baik' ? 'selected' : '' }}>Baik</option>
                                <option value="Layak" {{ request('kondisi') == 'Layak' ? 'selected' : '' }}>Layak</option>
                                <option value="Rusak" {{ request('kondisi') == 'Rusak' ? 'selected' : '' }}>Rusak</option>
                                <option value="Expired" {{ request('kondisi') == 'Expired' ? 'selected' : '' }}>Expired
                                </option>
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
                            Pembelian</label>
                        <input type="number" name="tahun_pembelian" value="{{ request('tahun_pembelian') }}"
                            placeholder="cth: 2024"
                            class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner placeholder:text-slate-300">
                    </div>
                    <div class="space-y-1.5">
                        <label
                            class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Ruangan</label>
                        <div class="relative">
                            <select name="ruangan_id"
                                class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner">
                                <option value="">Semua</option>
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
                    <div class="flex items-end gap-2 lg:col-span-2">
                        <button type="submit"
                            class="flex-1 rounded-xl bg-[#004500] px-6 py-2.5 text-sm font-bold text-white shadow-sm hover:bg-[#003800] transition">Filter
                            Data</button>
                        <a href="{{ route('aset.index') }}"
                            class="flex-1 rounded-xl bg-slate-100 px-6 py-2.5 text-sm font-bold text-slate-500 hover:bg-slate-200 transition border border-slate-200/50 text-center">Reset</a>
                        <a href="{{ route('aset.create') }}"
                            class="flex-1 inline-flex items-center justify-center gap-2 rounded-xl bg-[#1C7791] px-6 py-2.5 text-sm font-bold text-white shadow-sm hover:brightness-110 transition">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                    d="M12 4v16m8-8H4" />
                            </svg>
                            Aset Baru
                        </a>
                    </div>
                </div>
            </form>
        </div>

        {{-- Table --}}
        <div class="glass-card rounded-2xl overflow-hidden">
            <div class="overflow-x-auto">
                <table class="w-full text-sm">
                    <thead>
                        <tr class="bg-slate-900/5 backdrop-blur-md text-slate-500">
                            <th class="px-6 py-4 text-left font-black uppercase tracking-widest text-[10px]">NOMOR SERI
                                INVENTARIS</th>
                            <th class="px-6 py-4 text-left font-black uppercase tracking-widest text-[10px]">Identitas
                                Barang</th>
                            <th class="px-6 py-4 text-left font-black uppercase tracking-widest text-[10px]">Lokasi</th>
                            <th class="px-6 py-4 text-center font-black uppercase tracking-widest text-[10px] w-20">Qty</th>
                            <th class="px-6 py-4 text-center font-black uppercase tracking-widest text-[10px] w-28">Kondisi
                            </th>
                            <th class="px-6 py-4 text-center font-black uppercase tracking-widest text-[10px] w-40">Aksi
                            </th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-200/50">
                        @forelse($aset as $a)
                                        <tr class="hover:bg-white/40 transition-colors group">
                                            <td class="px-6 py-4">
                                                <a href="{{ route('aset.show', $a) }}"
                                                    class="font-mono text-[10px] font-black text-[#1C7791] hover:text-[#004500] transition-colors uppercase tracking-widest">
                                                    {{ $a->nomor_seri_inventaris ?? '-' }}
                                                </a>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="font-bold text-slate-800 tracking-tight leading-tight">{{
                            $a->jenisBarang?->nama_jenis }}</p>
                                                <p class="text-[10px] font-bold text-slate-400 uppercase tracking-wider">{{ $a->merk ?? '-'
                                                                        }} · {{ $a->tahun_pembelian }}</p>
                                            </td>
                                            <td class="px-6 py-4">
                                                <p class="text-[10px] font-black text-slate-700 uppercase tracking-tight">{{
                            $a->ruangan?->nama_ruangan }}</p>
                                                <p class="text-[9px] font-black text-slate-400 uppercase tracking-widest opacity-70">{{
                            $a->ruangan?->lokasi?->nama_lokasi }}</p>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <span
                                                    class="inline-flex items-center justify-center min-w-[2.5rem] h-7 rounded-xl bg-slate-900/5 px-3 text-[11px] font-black text-slate-600 border border-slate-900/5 shadow-inner">
                                                    {{ $a->jumlah }}
                                                </span>
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                @if($a->kondisi === 'Baik')
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-xl text-[9px] font-black uppercase bg-emerald-500/10 text-emerald-600 border border-emerald-500/20">Baik</span>
                                                @elseif($a->kondisi === 'Layak')
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-xl text-[9px] font-black uppercase bg-amber-500/10 text-amber-600 border border-amber-500/20">Layak</span>
                                                @elseif($a->kondisi === 'Rusak')
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-xl text-[9px] font-black uppercase bg-red-500/10 text-red-600 border border-red-500/20">Rusak</span>
                                                @else
                                                    <span
                                                        class="inline-flex items-center px-3 py-1 rounded-xl text-[9px] font-black uppercase bg-slate-500/10 text-slate-600 border border-slate-500/20">Expired</span>
                                                @endif
                                            </td>
                                            <td class="px-6 py-4 text-center">
                                                <div class="flex items-center justify-center gap-2">
                                                    <a href="{{ route('aset.edit', $a) }}"
                                                        class="rounded-xl bg-amber-500/10 p-2 text-amber-600 hover:bg-amber-500/20 transition-all"
                                                        title="Edit">
                                                        <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                                d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z" />
                                                        </svg>
                                                    </a>
                                                    <form action="{{ route('aset.destroy', $a) }}" method="POST"
                                                        onsubmit="return confirm('Yakin ingin menghapus aset ini?')">
                                                        @csrf @method('DELETE')
                                                        <button
                                                            class="rounded-xl bg-red-500/10 p-2 text-red-600 hover:bg-red-500/20 transition-all"
                                                            title="Hapus">
                                                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                                    d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                                            </svg>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="px-6 py-12 text-center text-slate-400 italic font-bold">
                                    Tidak ada data aset ditemukan.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>

        {{-- Pagination --}}
        <div class="mt-6">
            {{ $aset->links() }}
        </div>
    </div>

    </div>
@endsection