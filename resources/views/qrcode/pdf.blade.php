<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <title>Label QR Code Ruangan</title>
    <style>
        @page {
            margin: 0.5cm;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        body {
            font-family: 'Plus Jakarta Sans', 'Helvetica', 'Arial', sans-serif;
            background: #fff;
            padding: 10px;
        }

        .grid {
            width: 100%;
            table-layout: fixed;
            border-collapse: collapse;
        }

        .grid td {
            width: 33.33%;
            padding: 12px;
            vertical-align: top;
        }

        .card {
            border: 2px solid #000;
            border-radius: 12px;
            padding: 20px 15px;
            text-align: center;
            page-break-inside: avoid;
            background: #fff;
            height: 240px;
            display: block;
            position: relative;
            overflow: hidden;
        }

        /* Designer Accent */
        .card::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 4px;
            background: #000;
        }

        .header-tag {
            margin-bottom: 12px;
            text-align: center;
        }

        .header-tag img {
            height: 30px;
            width: auto;
        }

        .qr-wrapper {
            background: #fff;
            padding: 5px;
            display: inline-block;
            border: 1px solid #f0f0f0;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .info-section {
            padding: 0 5px;
        }

        .nama-ruangan {
            font-size: 14px;
            font-weight: 900;
            color: #000;
            line-height: 1.1;
            margin-bottom: 6px;
            text-transform: uppercase;
            letter-spacing: -0.5px;
        }

        .lokasi-tag {
            font-size: 10px;
            color: #666;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 1px;
        }

        .footer-branding {
            position: absolute;
            bottom: 12px;
            left: 0;
            width: 100%;
            font-size: 8px;
            font-weight: 800;
            color: #333;
            text-transform: uppercase;
            letter-spacing: 0.8px;
        }

        .footer-branding span {
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .footer-branding span::before,
        .footer-branding span::after {
            content: "";
            height: 1px;
            flex: 1;
            background: #ccc;
        }
    </style>
</head>

<body>
    @if($items->count() > 0)
        <table class="grid" cellspacing="0" cellpadding="0">
            @foreach($items->chunk(3) as $row)
                <tr>
                    @foreach($row as $item)
                        <td>
                            <div class="card">
                                <div class="header-tag">
                                    <img src="{{ public_path('perumda.png') }}" alt="Logo Perumda">
                                </div>

                                <div class="qr-wrapper">
                                    <img src="data:image/png;base64,{{ $item['qrBase64'] }}" width="110" height="110">
                                </div>

                                <div class="info-section">
                                    <div class="nama-ruangan">{{ $item['ruangan']->nama_ruangan }}</div>
                                    <div class="lokasi-tag">{{ $item['ruangan']->lokasi?->nama_lokasi }}</div>
                                </div>

                                <div class="footer-branding">
                                    <span>Scan untuk info aset ruangan ini</span>
                                </div>
                            </div>
                        </td>
                    @endforeach
                    @for($i = $row->count(); $i < 3; $i++)
                        <td>
                        </td>
                    @endfor
                </tr>
            @endforeach
        </table>
    @else
        <p style="text-align: center; color: #999; padding: 40px 0;">Tidak ada ruangan yang dipilih.</p>
    @endif
</body>

</html>