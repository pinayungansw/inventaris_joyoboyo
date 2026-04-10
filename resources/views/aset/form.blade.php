@extends('layouts.app')
@section('title', isset($aset) ? 'Edit Aset' : 'Tambah Aset')
@section('page-title', isset($aset) ? 'Edit Aset' : 'Tambah Aset Baru')

@section('content')
<div class="max-w-2xl">
    <div class="rounded-2xl bg-white p-8 shadow-sm border border-slate-200">
        <form action="{{ isset($aset) ? route('aset.update', $aset) : route('aset.store') }}" method="POST">
            @csrf
            @if(isset($aset)) @method('PUT') @endif

            <div class="grid grid-cols-1 sm:grid-cols-2 gap-6">
                {{-- Lokasi (helper for dependent dropdown) --}}
                <div class="space-y-1.5">
                    <label
                        class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Lokasi</label>
                    <div class="relative">
                        <select id="lokasi_select"
                            class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner"
                            required>
                            <option value="">Pilih Lokasi</option>
                            @foreach($lokasi as $l)
                            <option value="{{ $l->id }}" {{ old('_lokasi_id', isset($aset) ? $aset->ruangan?->lokasi_id
                                :
                                '') == $l->id ? 'selected' : '' }}
                                data-ruangan='@json($l->ruangan)'>
                                {{ $l->nama_lokasi }}
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

                {{-- Ruangan (dependent) --}}
                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Ruangan
                        <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="ruangan_select" name="ruangan_id"
                            class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner"
                            required>
                            <option value="">Pilih Ruangan</option>
                        </select>
                        <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M19 9l-7 7-7-7" />
                            </svg>
                        </div>
                    </div>
                </div>

                {{-- Klasifikasi (helper for dependent dropdown) --}}
                <div class="space-y-1.5">
                    <label
                        class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Klasifikasi</label>
                    <div class="relative">
                        <select id="klasifikasi_select"
                            class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner"
                            required>
                            <option value="">Pilih Klasifikasi</option>
                            @foreach($klasifikasi as $k)
                            <option value="{{ $k->id }}" {{ old('_klasifikasi_id', isset($aset) ? $aset->
                                jenisBarang?->klasifikasi_id : '') == $k->id ? 'selected' : '' }}
                                data-jenis='@json($k->jenisBarang)'>
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

                {{-- Jenis Barang (dependent) --}}
                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Jenis
                        Barang <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select id="jenis_barang_select" name="jenis_barang_id"
                            class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner"
                            required>
                            <option value="">Pilih Jenis Barang</option>
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
                    <label
                        class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Merk</label>
                    <input type="text" name="merk" value="{{ old('merk', $aset->merk ?? '') }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner placeholder:text-slate-300"
                        placeholder="cth: Chetose, Epson L3210">
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Tahun
                        Pembelian <span class="text-red-500">*</span></label>
                    <input type="number" name="tahun_pembelian"
                        value="{{ old('tahun_pembelian', $aset->tahun_pembelian ?? date('Y')) }}" min="0"
                        max="{{ date('Y') + 1 }}"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner"
                        required>
                </div>

                <div class="space-y-1.5">
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Kondisi
                        <span class="text-red-500">*</span></label>
                    <div class="relative">
                        <select name="kondisi"
                            class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner"
                            required>
                            <option value="Baik" {{ old('kondisi', $aset->kondisi ?? '') == 'Baik' ? 'selected' : ''
                                }}>Baik</option>
                            <option value="Layak" {{ old('kondisi', $aset->kondisi ?? '') == 'Layak' ? 'selected' : ''
                                }}>Layak</option>
                            <option value="Rusak" {{ old('kondisi', $aset->kondisi ?? '') == 'Rusak' ? 'selected' : ''
                                }}>Rusak</option>
                            <option value="Expired" {{ old('kondisi', $aset->kondisi ?? '') == 'Expired' ? 'selected' :
                                ''
                                }}>Expired</option>
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
                    <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Jumlah
                        <span class="text-red-500">*</span></label>
                    <input type="number" name="jumlah" value="{{ old('jumlah', $aset->jumlah ?? 1) }}" min="1"
                        class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner"
                        required>
                </div>
            </div>

            <div class="mt-6 space-y-1.5">
                <label
                    class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Spesifikasi</label>
                <textarea name="spesifikasi" rows="2"
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner placeholder:text-slate-300"
                    placeholder="cth: Silver Core i3, 40 inch">{{ old('spesifikasi', $aset->spesifikasi ?? '') }}</textarea>
            </div>

            <div class="mt-6 space-y-1.5">
                <label
                    class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">Keterangan</label>
                <textarea name="keterangan" rows="2"
                    class="w-full bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner">{{ old('keterangan', $aset->keterangan ?? '') }}</textarea>
            </div>

            <div class="flex items-center gap-3 mt-8">
                <button type="submit"
                    class="rounded-xl bg-[#004500] px-8 py-3 text-sm font-bold text-white shadow-sm hover:bg-[#003800] transition active:scale-[0.98]">
                    {{ isset($aset) ? 'Simpan Perubahan' : 'Daftarkan Aset Baru' }}
                </button>
                <a href="{{ route('aset.index') }}"
                    class="rounded-xl bg-slate-100 px-8 py-3 text-sm font-bold text-slate-500 hover:bg-slate-200 transition border border-slate-200/50">
                    Batal
                </a>
            </div>
        </form>
    </div>
</div>
@endsection

@push('scripts')
<script>
    document.addEventListener('DOMContentLoaded', function () {
        var lokasiSelect = document.getElementById('lokasi_select');
        var ruanganSelect = document.getElementById('ruangan_select');
        var klasifikasiSelect = document.getElementById('klasifikasi_select');
        var jenisBarangSelect = document.getElementById('jenis_barang_select');

        var currentRuanganId = '{{ old("ruangan_id", $aset->ruangan_id ?? "") }}';
        var currentJenisBarangId = '{{ old("jenis_barang_id", $aset->jenis_barang_id ?? "") }}';

        function populateDropdown(select, items, currentValue, labelKey, valueKey) {
            valueKey = valueKey || 'id';
            select.innerHTML = '<option value="">Pilih...</option>';
            for (var i = 0; i < items.length; i++) {
                var opt = document.createElement('option');
                opt.value = items[i][valueKey];
                opt.textContent = items[i][labelKey];
                if (String(items[i][valueKey]) === String(currentValue)) {
                    opt.selected = true;
                }
                select.appendChild(opt);
            }
        }

        lokasiSelect.addEventListener('change', function () {
            var selected = this.options[this.selectedIndex];
            var ruangan = selected.dataset.ruangan ? JSON.parse(selected.dataset.ruangan) : [];
            populateDropdown(ruanganSelect, ruangan, currentRuanganId, 'nama_ruangan');
        });

        klasifikasiSelect.addEventListener('change', function () {
            var selected = this.options[this.selectedIndex];
            var jenis = selected.dataset.jenis ? JSON.parse(selected.dataset.jenis) : [];
            populateDropdown(jenisBarangSelect, jenis, currentJenisBarangId, 'nama_jenis');
        });

        if (lokasiSelect.value) lokasiSelect.dispatchEvent(new Event('change'));
        if (klasifikasiSelect.value) klasifikasiSelect.dispatchEvent(new Event('change'));

        // Form logic removed as it's now a simple string input
    });
</script>
@endpush