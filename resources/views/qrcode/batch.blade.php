@extends('layouts.app')
@section('title', 'QR Code Ruangan')
@section('page-title', 'QR Code Ruangan')

@section('content')
<div class="space-y-6">
    {{-- Header --}}
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4">
        <p class="text-sm text-slate-500">Pilih ruangan untuk download label QR Code secara kolektif.</p>
        <form method="GET" action="{{ route('qr.download-pdf') }}" id="downloadForm">
            <button type="submit"
                class="inline-flex items-center gap-2 rounded-xl bg-[#004500] px-5 py-2.5 text-sm font-bold text-white hover:bg-[#003800] transition shadow-sm">
                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                        d="M12 10v6m0 0l-3-3m3 3l3-3m2 8H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                </svg>
                <span id="downloadBtnText">Download PDF Semua</span>
            </button>
        </form>
    </div>

    {{-- QR Grid --}}
    @if($items->count() > 0)
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($items as $item)
        <label class="group relative block cursor-pointer select-none">
            <input type="checkbox" name="ruangan_ids[]" value="{{ $item['ruangan']->id }}" form="downloadForm"
                class="peer hidden" onchange="updateDownloadBtn()">

            <div class="relative h-full rounded-2xl bg-white p-5 shadow-sm border border-slate-200 transition-all duration-300
                       peer-checked:bg-blue-50/50 peer-checked:border-blue-500 peer-checked:ring-4 peer-checked:ring-blue-500/10
                       hover:border-slate-300 hover:shadow-md active:scale-[0.98]">

                {{-- Selection Checkmark --}}
                <div
                    class="absolute -top-2 -right-2 h-6 w-6 rounded-full bg-blue-600 text-white shadow-lg flex items-center justify-center opacity-0 scale-50 transition-all duration-300 peer-checked:opacity-100 peer-checked:scale-100 z-10">
                    <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="3" d="M5 13l4 4L19 7" />
                    </svg>
                </div>

                <div class="flex items-start gap-4">
                    {{-- QR Preview --}}
                    <div
                        class="shrink-0 rounded-xl border border-slate-100 p-2 bg-slate-50 group-hover:bg-white transition-colors duration-300">
                        <div class="bg-white p-1 rounded-lg">
                            {!! $item['qrCode'] !!}
                        </div>
                    </div>
                    {{-- Info --}}
                    <div class="flex-1 min-w-0 text-left">
                        <div class="space-y-1">
                            <p class="font-bold text-slate-800 truncate leading-tight">{{ $item['ruangan']->nama_ruangan
                                }}</p>
                            <p class="text-[10px] font-bold text-slate-400 uppercase tracking-widest">{{
                                $item['ruangan']->lokasi?->nama_lokasi }}</p>

                            <div class="pt-3">
                                <object>
                                    <a href="{{ route('ruangan.inventaris', $item['ruangan']) }}"
                                        class="inline-flex items-center gap-2 rounded-lg bg-slate-50 px-3 py-1.5 text-[10px] font-extrabold text-slate-500 hover:bg-slate-100 hover:text-slate-900 uppercase tracking-wider transition-all relative z-20">
                                        <span>Buka Pratinjau</span>
                                        <svg class="w-3.5 h-3.5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5"
                                                d="M10 6H6a2 2 0 00-2 2v10a2 2 0 002 2h10a2 2 0 002-2v-4M14 4h6m0 0v6m0-6L10 14" />
                                        </svg>
                                    </a>
                                </object>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </label>
        @endforeach
    </div>
    @else
    <div class="rounded-2xl bg-white p-16 shadow-sm border border-dashed border-slate-200 text-center">
        <div class="inline-flex h-12 w-12 items-center justify-center rounded-full bg-slate-50 text-slate-400 mb-4">
            <svg class="w-6 h-6" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                    d="M12 4v1m6 11h2m-6 0h-2v4m0-11v3m0 0h.01M12 12h4.01M16 20h4M4 12h4m12 0h.01" />
            </svg>
        </div>
        <p class="text-slate-500 font-medium">Belum ada data ruangan.</p>
    </div>
    @endif
</div>

@push('scripts')
<script>
    function updateDownloadBtn() {
        const realChecked = document.querySelectorAll('input[name="ruangan_ids[]"]:checked');
        const btn = document.getElementById('downloadBtnText');
        if (realChecked.length > 0) {
            btn.textContent = 'Download PDF (' + realChecked.length + ' ruangan)';
        } else {
            btn.textContent = 'Download PDF Semua';
        }
    }
</script>
@endpush
@endsection