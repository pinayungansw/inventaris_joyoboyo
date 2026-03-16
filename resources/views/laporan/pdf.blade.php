<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Laporan Inventaris Aset</title>
    <style>
        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            font-size: 11px;
            color: #333;
        }

        h1 {
            font-size: 16px;
            text-align: center;
            margin-bottom: 2px;
        }

        h2 {
            font-size: 12px;
            text-align: center;
            color: #666;
            margin-bottom: 15px;
            font-weight: normal;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        th,
        td {
            border: 1px solid #ccc;
            padding: 5px 8px;
            text-align: left;
        }

        th {
            background-color: #f1f5f9;
            font-weight: bold;
            font-size: 10px;
        }

        tr:nth-child(even) {
            background-color: #fafafa;
        }

        .text-center {
            text-align: center;
        }

        .badge {
            padding: 2px 6px;
            border-radius: 4px;
            font-size: 9px;
            font-weight: bold;
        }

        .badge-baik {
            background: #d1fae5;
            color: #065f46;
        }

        .badge-layak {
            background: #fef3c7;
            color: #92400e;
        }

        .badge-rusak {
            background: #fee2e2;
            color: #991b1b;
        }

        /* Professional Kop Surat Styles */
        .kop-surat-wrapper {
            width: 100%;
            border-bottom: 3px solid #000;
            padding-bottom: 2px;
            margin-bottom: 2px;
        }

        .kop-surat-inner {
            border-bottom: 1px solid #000;
            padding-bottom: 2px;
            margin-bottom: 20px;
        }

        }

        .kop-table {
            width: 100%;
            border-collapse: collapse;
            border: none;
            margin-bottom: 5px;
        }

        .kop-table td {
            border: none;
            vertical-align: middle;
            padding: 0;
        }

        .kop-logo-col {
            width: 120px;
            text-align: left;
        }

        .kop-text-col {
            text-align: left;
        }

        .kop-title-1 {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            font-size: 13pt;
            font-weight: bold;
            color: #0b5edd;
            margin: 0 0 2px 0;
            letter-spacing: 0px;
        }

        .kop-title-2 {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            font-size: 18pt;
            font-weight: bold;
            color: #333;
            margin: 0 0 5px 0;
            letter-spacing: 0px;
        }

        .kop-address {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            font-size: 10pt;
            color: #333;
            margin: 0 0 2px 0;
        }

        .kop-contact {
            font-family: 'Plus Jakarta Sans', Arial, sans-serif;
            font-size: 10pt;
            color: #333;
            margin: 0;
        }

        .report-title-container {
            text-align: center;
            margin-bottom: 20px;
        }

        .report-title {
            font-size: 14pt;
            font-weight: bold;
            margin: 0 0 5px 0;
            text-decoration: underline;
        }

        .report-subtitle {
            font-size: 10pt;
            margin: 0;
        }
    </style>
</head>

<body>
    <div class="kop-surat-wrapper">
        <div class="kop-surat-inner">
            <table class="kop-table">
                <tr>
                    <td class="kop-logo-col">
                        <img src="{{ public_path('perumda.png') }}" style="width: 100px; height: auto;">
                    </td>
                    <td class="kop-text-col">
                        <div class="kop-title-1">PERUSAHAAN UMUM DAERAH PASAR JOYOBOYO</div>
                        <div class="kop-title-2">PEMERINTAH KOTA KEDIRI</div>
                        <div class="kop-address">Jl. Brigadir Jenderal Polisi Imam Bahri No. 92, Kelurahan Bangsal,
                            Kecamatan Pesantren, Kota Kediri 64131</div>
                        <div class="kop-contact">Telp: (0354) 671212 &nbsp;&middot;&nbsp; Email:
                            pasarjoyoboyokotakediri@gmail.com &nbsp;&middot;&nbsp; Web:
                            perumdapasarjoyoboyo.kedirikota.go.id</div>
                    </td>
                </tr>
            </table>
        </div>
    </div>


    <div class="report-title-container">
        <div class="report-title">
            {{ strtoupper('Laporan Inventaris Aset') }}
            @if($selectedLokasi) - {{ strtoupper($selectedLokasi) }} @endif
            @if($selectedRuangan) - {{ strtoupper($selectedRuangan) }} @endif
        </div>
        <div class="report-subtitle">Tanggal Cetak: {{ date('d/m/Y H:i') }}</div>
    </div>

    <table>
        <thead>
            <tr>
                <th class="text-center">{{ strtoupper('No') }}</th>
                <th>{{ strtoupper('Nomor Seri Inventaris') }}</th>
                <th>{{ strtoupper('Klasifikasi') }}</th>
                <th>{{ strtoupper('Jenis Barang') }}</th>
                <th>{{ strtoupper('Lokasi') }}</th>
                <th>{{ strtoupper('Ruangan') }}</th>
                <th>{{ strtoupper('Merk') }}</th>
                <th>{{ strtoupper('Spesifikasi') }}</th>
                <th class="text-center">{{ strtoupper('Tahun') }}</th>
                <th class="text-center">{{ strtoupper('Kondisi') }}</th>
                <th class="text-center">{{ strtoupper('Jml') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($aset as $i => $a)
                <tr>
                    <td class="text-center">{{ $i + 1 }}</td>
                    <td>{{ $a->nomor_seri_inventaris }}</td>
                    <td>{{ $a->jenisBarang?->klasifikasi?->nama_klasifikasi ?? '-' }}</td>
                    <td>{{ $a->jenisBarang?->nama_jenis ?? '-' }}</td>
                    <td>{{ $a->ruangan?->lokasi?->nama_lokasi ?? '-' }}</td>
                    <td>{{ $a->ruangan?->nama_ruangan ?? '-' }}</td>
                    <td>{{ $a->merk ?? '-' }}</td>
                    <td>{{ $a->spesifikasi ?? '-' }}</td>
                    <td class="text-center">{{ $a->tahun_pembelian }}</td>
                    <td class="text-center">
                        @if($a->kondisi === 'Baik')
                            <span class="badge badge-baik">Baik</span>
                        @elseif($a->kondisi === 'Layak')
                            <span class="badge badge-layak">Layak</span>
                        @else
                            <span class="badge badge-rusak">Rusak</span>
                        @endif
                    </td>
                    <td class="text-center">{{ $a->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div class="footer">
        Total: {{ $aset->count() }} item | Dicetak oleh Sistem Inventaris Perumda
    </div>
</body>

</html>