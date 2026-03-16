@extends('layouts.app')
@section('title', 'Mutasi Aset Baru')
@section('page-title', 'Mutasi Aset Baru')

@section('content')
    <div class="max-w-xl">
        <div class="rounded-2xl bg-white p-8 shadow-sm border border-slate-200">
            <form action="{{ route('mutasi.store') }}" method="POST">
                @csrf

                <div class="space-y-6">

                    {{-- STEP 1: Pilih Lokasi --}}
                    <div class="space-y-1.5">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">
                            1. Pilih Lokasi Aset <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="filter-lokasi"
                                class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner">
                                <option value="">— Pilih Lokasi —</option>
                                @foreach($lokasi as $lok)
                                    <option value="{{ $lok->id }}">{{ $lok->nama_lokasi }}</option>
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

                    {{-- STEP 2: Pilih Ruangan (muncul setelah lokasi dipilih) --}}
                    <div class="space-y-1.5" id="wrap-ruangan" style="display:none">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">
                            2. Pilih Ruangan <span class="text-red-500">*</span>
                        </label>
                        <div class="relative">
                            <select id="filter-ruangan"
                                class="w-full appearance-none bg-slate-50 border border-slate-200 rounded-xl px-4 py-2.5 pr-10 text-sm font-medium text-slate-700 focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20 transition-all shadow-inner">
                                <option value="">— Pilih Ruangan —</option>
                            </select>
                            <div class="absolute inset-y-0 right-3 flex items-center pointer-events-none text-slate-400">
                                <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                        d="M19 9l-7 7-7-7" />
                                </svg>
                            </div>
                        </div>
                    </div>

                    {{-- STEP 3: Pilih Aset (muncul setelah ruangan dipilih) --}}
                    <div class="space-y-1.5" id="wrap-aset" style="display:none">
                        <label class="block text-[10px] font-bold text-slate-400 uppercase tracking-widest ml-1">
                            3. Pilih Aset <span class="text-red-500">*</span>
                        </label>
                        <input type="hidden" name="aset_id" id="aset_id_input"
                            value="{{ old('aset_id', $aset?->id ?? '') }}" required>

                        {{-- Search bar --}}
                        <input type="text" id="aset-search"
                            class="w-full px-4 py-2.5 text-xs text-slate-700 bg-slate-50 border border-slate-200 rounded-xl focus:outline-none focus:ring-2 focus:ring-[#1C7791]/20"
                            placeholder="Cari kode atau nama aset…">

                        <div class="divide-y divide-slate-100 border border-slate-200 rounded-xl overflow-hidden bg-white max-h-52 overflow-y-auto"
                            id="aset-radio-list">
                            {{-- Diisi oleh JS --}}
                        </div>
                        <p id="aset-empty-msg" class="hidden text-xs text-slate-400 italic text-center py-3">Tidak ada aset di ruangan ini.</p>
                        <p id="aset-no-result" class="hidden text-xs text-slate-400 italic text-center py-3">Tidak ada hasil ditemukan.</p>
                    </div>

                    {{-- Info aset terpilih --}}
                    <div id="aset-info"
                        class="hidden p-4 rounded-xl bg-[#1C7791]/5 border border-[#1C7791]/10 flex items-start gap-3">
                        <div
                            class="w-8 h-8 rounded-lg bg-white flex items-center justify-center text-[#1C7791] shadow-sm flex-shrink-0">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                    d="M9 5H7a2 2 0 00-2 2v12a2 2 0 002 2h10a2 2 0 002-2V7a2 2 0 00-2-2h-2M9 5a2 2 0 002 2h2a2 2 0 002-2M9 5a2 2 0 012-2h2a2 2 0 012 2" />
                            </svg>
                        </div>
                        <div>
                            <p class="text-[10px] font-bold text-[#1C7791] uppercase tracking-wider">Aset Dipilih</p>
                            <p class="text-sm font-bold text-slate-700" id="aset-info-name">—</p>
                            <p class="text-xs text-slate-400 mt-0.5" id="aset-info-loc">—</p>
                        </div>
                    </div>

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
                                    <option value="{{ $r->id }}" {{ old('ke_ruangan_id') == $r->id ? 'selected' : '' }}>
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

@push('scripts')
    <script>
        // Data semua aset & ruangan dari PHP → JS
        const allAset = @json($asetData);
        const allRuangan = @json($ruanganData);

        const selLokasi = document.getElementById('filter-lokasi');
        const selRuangan = document.getElementById('filter-ruangan');
        const wrapRuangan = document.getElementById('wrap-ruangan');
        const wrapAset = document.getElementById('wrap-aset');
        const asetList = document.getElementById('aset-radio-list');
        const asetEmpty = document.getElementById('aset-empty-msg');
        const hiddenAset = document.getElementById('aset_id_input');
        const asetInfo = document.getElementById('aset-info');
        const asetName = document.getElementById('aset-info-name');
        const asetLoc = document.getElementById('aset-info-loc');

        // Step 1: Lokasi berubah → isi dropdown ruangan
        selLokasi.addEventListener('change', function () {
            const lokasiId = parseInt(this.value);
            selRuangan.innerHTML = '<option value="">— Pilih Ruangan —</option>';
            hiddenAset.value = '';
            asetList.innerHTML = '';
            asetInfo.classList.add('hidden');
            wrapAset.style.display = 'none';
            asetEmpty.classList.add('hidden');

            if (!lokasiId) { wrapRuangan.style.display = 'none'; return; }

            const filtered = allRuangan.filter(r => r.lokasi_id === lokasiId);
            filtered.forEach(r => {
                const opt = document.createElement('option');
                opt.value = r.id;
                opt.textContent = r.nama;
                selRuangan.appendChild(opt);
            });
            wrapRuangan.style.display = 'block';
            wrapRuangan.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });

        // Step 2: Ruangan berubah → tampilkan aset sebagai radio list
        selRuangan.addEventListener('change', function () {
            const ruanganId = parseInt(this.value);
            asetList.innerHTML = '';
            hiddenAset.value = '';
            asetInfo.classList.add('hidden');
            const srch = document.getElementById('aset-search');
            if (srch) { srch.value = ''; }
            document.getElementById('aset-no-result').classList.add('hidden');

            if (!ruanganId) { wrapAset.style.display = 'none'; asetEmpty.classList.add('hidden'); return; }

            const filtered = allAset.filter(a => a.ruangan_id === ruanganId);

            if (filtered.length === 0) {
                wrapAset.style.display = 'block';
                asetEmpty.classList.remove('hidden');
                asetList.innerHTML = '';
                return;
            }

            asetEmpty.classList.add('hidden');
            filtered.forEach(a => {
                const item = document.createElement('label');
                item.className = 'flex items-center gap-3 px-4 py-3 cursor-pointer hover:bg-[#1C7791]/5 transition-colors';
                item.innerHTML = `
                <input type="radio" name="_aset_radio" value="${a.id}"
                    class="accent-[#1C7791] w-4 h-4 flex-shrink-0">
                <span class="leading-snug">
                    <span class="font-bold text-[#1C7791] text-xs">[${a.kode}]</span>
                    <span class="text-sm font-medium text-slate-700 ml-1">${a.label}</span>
                    <span class="block text-[10px] text-slate-400 mt-0.5">${a.lokasi} / ${a.ruangan}</span>
                </span>
            `;
                item.querySelector('input').addEventListener('change', function () {
                    hiddenAset.value = a.id;
                    asetName.textContent = `[${a.kode}] ${a.label}`;
                    asetLoc.textContent = `${a.lokasi} / ${a.ruangan}`;
                    asetInfo.classList.remove('hidden');
                });
                asetList.appendChild(item);
            });

            wrapAset.style.display = 'block';
            wrapAset.scrollIntoView({ behavior: 'smooth', block: 'nearest' });
        });

        // Filter aset saat mengetik
        document.getElementById('aset-search').addEventListener('input', function () {
            const q = this.value.toLowerCase();
            const rows = asetList.querySelectorAll('label');
            let found = 0;
            rows.forEach(function (row) {
                const match = row.textContent.toLowerCase().includes(q);
                row.style.display = match ? '' : 'none';
                if (match) found++;
            });
            document.getElementById('aset-no-result').classList.toggle('hidden', found > 0);
        });
    </script>
@endpush