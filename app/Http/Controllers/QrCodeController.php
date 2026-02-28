<?php

namespace App\Http\Controllers;

use App\Models\MasterRuangan;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade\Pdf;
use BaconQrCode\Encoder\Encoder;
use BaconQrCode\Common\ErrorCorrectionLevel;

class QrCodeController extends Controller
{
    /**
     * Halaman batch: daftar ruangan dengan preview QR code (SVG).
     */
    public function printBatch()
    {
        $ruangan = MasterRuangan::with('lokasi')
            ->withCount('aset')
            ->get();

        $items = $ruangan->map(function ($r) {
            return [
                'ruangan' => $r,
                'qrCode' => QrCode::size(120)->generate(route('ruangan.inventaris', $r->id)),
            ];
        });

        return view('qrcode.batch', compact('items', 'ruangan'));
    }

    /**
     * Generate PNG QR code using GD (no imagick needed).
     */
    private function generateQrPng(string $data, int $size = 200): string
    {
        $qrCode = Encoder::encode($data, ErrorCorrectionLevel::L());
        $matrix = $qrCode->getMatrix();
        $matrixSize = $matrix->getWidth();

        $pixelSize = max(1, intval($size / $matrixSize));
        $imgSize = $matrixSize * $pixelSize;

        $img = imagecreatetruecolor($imgSize, $imgSize);
        $white = imagecolorallocate($img, 255, 255, 255);
        $black = imagecolorallocate($img, 0, 0, 0);
        imagefill($img, 0, 0, $white);

        for ($y = 0; $y < $matrixSize; $y++) {
            for ($x = 0; $x < $matrixSize; $x++) {
                if ($matrix->get($x, $y)) {
                    imagefilledrectangle(
                        $img,
                        $x * $pixelSize,
                        $y * $pixelSize,
                        ($x + 1) * $pixelSize - 1,
                        ($y + 1) * $pixelSize - 1,
                        $black
                    );
                }
            }
        }


        ob_start();
        imagepng($img);
        $png = ob_get_clean();
        imagedestroy($img);

        return $png;
    }

    /**
     * Download PDF label QR code per ruangan.
     */
    public function downloadPdf()
    {
        $ruanganIds = request('ruangan_ids', []);

        $query = MasterRuangan::with('lokasi')->withCount('aset');
        if (!empty($ruanganIds)) {
            $query->whereIn('id', $ruanganIds);
        }
        $ruangan = $query->get();

        $items = $ruangan->map(function ($r) {
            $png = $this->generateQrPng(route('ruangan.inventaris', $r->id), 200);
            return [
                'ruangan' => $r,
                'qrBase64' => base64_encode($png),
            ];
        });

        $filename = 'qrcode-ruangan-' . date('Y-m-d') . '.pdf';

        $pdf = Pdf::loadView('qrcode.pdf', compact('items'));
        $pdf->setPaper('a4', 'portrait');

        return $pdf->download($filename);
    }

    /**
     * Halaman publik inventaris ruangan (muncul saat scan QR).
     */
    public function inventaris(MasterRuangan $ruangan)
    {
        $ruangan->load(['lokasi']);

        // Paginate assets for the table
        $aset = $ruangan->aset()->with(['jenisBarang.klasifikasi'])->latest()->paginate(10);

        // Rekap still needs all assets in the room
        $allAset = $ruangan->aset()->with('jenisBarang')->get();
        $rekapAset = $allAset->groupBy('jenis_barang_id')->map(function ($items) {
            return [
                'nama' => $items->first()->jenisBarang?->nama_jenis ?? 'Unknown',
                'total' => $items->sum('jumlah')
            ];
        });

        return view('qrcode.inventaris', compact('ruangan', 'rekapAset', 'aset'));
    }
}