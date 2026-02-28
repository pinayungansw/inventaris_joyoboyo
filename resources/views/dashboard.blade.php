@extends('layouts.app')
@section('title', 'Dashboard')
@section('page-title', 'Dashboard')

@section('content')
<div class="space-y-6">

    {{-- Welcome Banner --}}
    <div class="rounded-2xl bg-[#004500] p-8 text-white shadow-md shadow-[#004500]/10 relative overflow-hidden">
        <div class="relative z-10">
            <h2 class="text-2xl font-bold tracking-tight">Selamat Datang, {{ Auth::user()->name }} 👋</h2>
            <p class="mt-1 text-sm text-white/70 font-medium">Ringkasan sistem inventaris Aset Perumda hari ini.</p>
        </div>
        {{-- Decorative element --}}
        <div class="absolute -right-8 -top-8 w-32 h-32 bg-white/10 rounded-full blur-3xl"></div>
        <div class="absolute -left-8 -bottom-8 w-48 h-48 bg-lime-400/10 rounded-full blur-3xl"></div>
    </div>

    {{-- Summary Cards --}}
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <div class="rounded-2xl bg-white border border-[#E2E8F0] p-5 shadow-sm">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Total Aset</p>
            <p class="mt-2 text-3xl font-bold text-slate-800">{{ number_format($totalAset) }}</p>
        </div>
        <div class="rounded-2xl bg-white border border-[#E2E8F0] p-5 shadow-sm">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Kondisi Baik</p>
            <p class="mt-2 text-3xl font-bold text-slate-800">{{ number_format($totalBaik) }}</p>
            <div class="mt-2 h-1 w-12 rounded-full bg-emerald-400"></div>
        </div>
        <div class="rounded-2xl bg-white border border-[#E2E8F0] p-5 shadow-sm">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Kondisi Layak</p>
            <p class="mt-2 text-3xl font-bold text-slate-800">{{ number_format($totalLayak) }}</p>
            <div class="mt-2 h-1 w-12 rounded-full bg-amber-400"></div>
        </div>
        <div class="rounded-2xl bg-white border border-[#E2E8F0] p-5 shadow-sm">
            <p class="text-xs font-semibold text-slate-400 uppercase tracking-wider">Kondisi Rusak</p>
            <p class="mt-2 text-3xl font-bold text-slate-800">{{ number_format($totalRusak) }}</p>
            <div class="mt-2 h-1 w-12 rounded-full bg-red-400"></div>
        </div>
    </div>

    {{-- Charts --}}
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-[#E2E8F0]">
            <h3 class="text-sm font-semibold text-slate-700 mb-4">Aset per Kondisi</h3>
            <div class="relative" style="height: 280px">
                <canvas id="chartKondisi"></canvas>
            </div>
        </div>
        <div class="rounded-2xl bg-white p-6 shadow-sm border border-[#E2E8F0]">
            <h3 class="text-sm font-semibold text-slate-700 mb-4">Aset per Lokasi</h3>
            <div class="relative" style="height: 280px">
                <canvas id="chartLokasi"></canvas>
            </div>
        </div>
    </div>

    {{-- Per Lokasi Table --}}
    <div class="rounded-2xl bg-white shadow-sm border border-[#E2E8F0] overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100">
            <h3 class="text-sm font-semibold text-slate-700">Ringkasan per Lokasi</h3>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Lokasi</th>
                        <th class="px-6 py-4 text-center font-medium uppercase tracking-wider text-[10px]">Total Aset
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @foreach($asetPerLokasi as $lok)
                    <tr class="hover:bg-slate-50/50">
                        <td class="px-6 py-3 font-medium text-slate-700">{{ $lok->nama_lokasi }}</td>
                        <td class="px-6 py-3 text-center">
                            <span
                                class="inline-flex items-center rounded-full bg-[#1C7791]/10 px-2.5 py-0.5 text-xs font-medium text-[#1C7791]">
                                {{ $lok->total_aset }}
                            </span>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

    {{-- Recent Assets --}}
    <div class="rounded-2xl bg-white shadow-sm border border-slate-200 overflow-hidden">
        <div class="px-6 py-4 border-b border-slate-100 flex items-center justify-between">
            <h3 class="text-sm font-bold text-slate-700">Aset Terbaru</h3>
            <a href="{{ route('aset.index') }}"
                class="rounded-xl bg-white px-4 py-2 text-xs font-bold text-slate-600 shadow-sm hover:bg-slate-50 transition border border-slate-200">
                Lihat Semua
            </a>
        </div>
        <div class="overflow-x-auto">
            <table class="w-full text-sm">
                <thead class="bg-slate-50 text-slate-500 border-b border-slate-100">
                    <tr>
                        <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Kode</th>
                        <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Jenis</th>
                        <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Merk</th>
                        <th class="px-6 py-4 text-left font-medium uppercase tracking-wider text-[10px]">Lokasi</th>
                        <th class="px-6 py-4 text-center font-medium uppercase tracking-wider text-[10px] w-28">Kondisi
                        </th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-100">
                    @forelse($recentAset as $a)
                    <tr class="hover:bg-slate-50/50 transition-colors">
                        <td class="px-6 py-4 font-mono text-xs font-bold text-[#1C7791]">
                            <a href="{{ route('aset.show', $a) }}" class="hover:underline">{{ $a->kode_aset }}</a>
                        </td>
                        <td class="px-6 py-4 font-medium text-slate-700">{{ $a->jenisBarang?->nama_jenis }}</td>
                        <td class="px-6 py-4 text-slate-500 font-medium text-xs">{{ $a->merk ?? '-' }}</td>
                        <td class="px-6 py-4">
                            <p class="text-[10px] font-bold text-slate-700 uppercase">{{ $a->ruangan?->nama_ruangan }}
                            </p>
                            <p class="text-[9px] font-bold text-slate-400 uppercase">{{
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
                        <td colspan="5" class="px-6 py-12 text-center">
                            <p class="text-slate-400 font-bold italic">Belum ada data aset.</p>
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // Kondisi chart
        new Chart(document.getElementById('chartKondisi'), {
            type: 'doughnut',
            data: {
                labels: ['Baik', 'Layak', 'Rusak'],
                datasets: [{
                    data: [{{ $totalBaik }}, {{ $totalLayak }}, {{ $totalRusak }}],
        backgroundColor: ['#34d399', '#fbbf24', '#f87171'],
        borderWidth: 0,
        borderRadius: 4,
                }]
            },
        options: {
        responsive: true,
        maintainAspectRatio: false,
        plugins: {
            legend: { position: 'bottom', labels: { usePointStyle: true, padding: 20, color: '#64748b' } }
        },
        cutout: '65%',
    }
        });

    // Lokasi chart
    new Chart(document.getElementById('chartLokasi'), {
        type: 'bar',
        data: {
            labels: {!! json_encode($asetPerLokasi-> pluck('nama_lokasi'))!!},
    datasets: [{
        label: 'Jumlah Aset',
        data: {!! json_encode($asetPerLokasi-> pluck('total_aset')) !!},
        backgroundColor: '#94a3b8',
        borderRadius: 8,
        barThickness: 40,
                }]
            },
    options: {
        responsive: true,
            maintainAspectRatio: false,
                plugins: { legend: { display: false } },
        scales: {
            y: { beginAtZero: true, grid: { color: '#f1f5f9' }, ticks: { color: '#94a3b8' } },
            x: { grid: { display: false }, ticks: { color: '#94a3b8' } }
        }
    }
        });
    });
</script>
@endpush