@extends('layouts.app')
@section('title', 'Master Klasifikasi')
@section('page-title', 'Master Klasifikasi')

@section('content')
<div class="space-y-6">
    <div class="flex items-center justify-between">
        <p class="text-sm text-slate-500">Kelola kategori besar aset</p>
        <a href="{{ route('master.klasifikasi.create') }}"
            class="inline-flex items-center gap-2 rounded-xl bg-[#004500] px-4 py-2.5 text-sm font-medium text-white shadow-sm hover:bg-[#003800] transition">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4" />
            </svg>
            Tambah Klasifikasi
        </a>
    </div>
    <div class="rounded-2xl bg-white shadow-sm border border-[#E2E8F0] overflow-hidden">
        <table class="w-full text-sm">
            <thead class="bg-slate-50 text-slate-500">
                <tr>

                    <th class="px-6 py-3 text-left font-medium">Nama Klasifikasi</th>
                    <th class="px-6 py-3 text-center font-medium">Jml Jenis Barang</th>
                    <th class="px-6 py-3 text-center font-medium w-40">Aksi</th>
                </tr>
            </thead>
            <tbody class="divide-y divide-slate-100">
                @forelse($klasifikasi as $i => $k)
                <tr class="hover:bg-slate-50/50">

                    <td class="px-6 py-3 font-medium text-slate-700">{{ $k->nama_klasifikasi }}</td>
                    <td class="px-6 py-3 text-center"><span
                            class="inline-flex items-center rounded-full bg-[#1C7791]/10 px-2.5 py-0.5 text-xs font-medium text-[#1C7791]">{{
                            $k->jenis_barang_count }}</span></td>
                    <td class="px-6 py-3 text-center">
                        <div class="flex items-center justify-center gap-2">
                            <a href="{{ route('master.klasifikasi.edit', $k) }}"
                                class="rounded-lg bg-amber-50 p-2 text-amber-600 hover:bg-amber-100 transition"><svg
                                    class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                                </svg></a>
                            <form action="{{ route('master.klasifikasi.destroy', $k) }}" method="POST"
                                onsubmit="return confirm('Yakin?')">@csrf @method('DELETE')<button
                                    class="rounded-lg bg-red-50 p-2 text-red-600 hover:bg-red-100 transition"><svg
                                        class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16" />
                                    </svg></button></form>
                        </div>
                    </td>
                </tr>
                @empty
                <tr>
                    <td colspan="4" class="px-6 py-8 text-center text-slate-400">Belum ada data.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
@endsection