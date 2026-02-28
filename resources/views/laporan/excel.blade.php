<table>
    <thead>
        {{-- Header rows 1-8 are generated dynamically in AsetExport.php --}}
        <tr>
            <th style="font-weight: bold; background-color: #f1f5f9; border: 1px solid #000;">No</th>
            <th style="font-weight: bold; background-color: #f1f5f9; border: 1px solid #000;">Nomor Seri Inventaris</th>
            <th style="font-weight: bold; background-color: #f1f5f9; border: 1px solid #000;">Klasifikasi</th>
            <th style="font-weight: bold; background-color: #f1f5f9; border: 1px solid #000;">Jenis Barang</th>
            <th style="font-weight: bold; background-color: #f1f5f9; border: 1px solid #000;">Lokasi</th>
            <th style="font-weight: bold; background-color: #f1f5f9; border: 1px solid #000;">Ruangan</th>
            <th style="font-weight: bold; background-color: #f1f5f9; border: 1px solid #000;">Merk</th>
            <th style="font-weight: bold; background-color: #f1f5f9; border: 1px solid #000;">Spesifikasi</th>
            <th style="font-weight: bold; background-color: #f1f5f9; border: 1px solid #000;">Tahun</th>
            <th style="font-weight: bold; background-color: #f1f5f9; border: 1px solid #000;">Kondisi</th>
            <th style="font-weight: bold; background-color: #f1f5f9; border: 1px solid #000;">Jumlah</th>
            <th style="font-weight: bold; background-color: #f1f5f9; border: 1px solid #000;">Keterangan</th>
        </tr>
    </thead>

    <tbody>
        @foreach($aset as $i => $a)
            <tr>
                <td style="border: 1px solid #000; text-align: center;">{{ $i + 1 }}</td>
                <td style="border: 1px solid #000;">{{ $a->nomor_seri_inventaris ?? $a->kode_aset }}</td>
                <td style="border: 1px solid #000;">{{ $a->jenisBarang?->klasifikasi?->nama_klasifikasi ?? '-' }}</td>
                <td style="border: 1px solid #000;">{{ $a->jenisBarang?->nama_jenis ?? '-' }}</td>
                <td style="border: 1px solid #000;">{{ $a->ruangan?->lokasi?->nama_lokasi ?? '-' }}</td>
                <td style="border: 1px solid #000;">{{ $a->ruangan?->nama_ruangan ?? '-' }}</td>
                <td style="border: 1px solid #000;">{{ $a->merk ?? '-' }}</td>
                <td style="border: 1px solid #000;">{{ $a->spesifikasi ?? '-' }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $a->tahun_pembelian }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $a->kondisi }}</td>
                <td style="border: 1px solid #000; text-align: center;">{{ $a->jumlah }}</td>
                <td style="border: 1px solid #000;">{{ $a->keterangan ?? '-' }}</td>
            </tr>
        @endforeach
    </tbody>
</table>