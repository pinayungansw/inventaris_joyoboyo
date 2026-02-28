<?php

namespace App\Exports;

use App\Models\Aset;
use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Events\AfterSheet;
use PhpOffice\PhpSpreadsheet\Worksheet\Drawing;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Style\Border;
use PhpOffice\PhpSpreadsheet\Style\Fill;

class AsetExport implements FromView, WithEvents, ShouldAutoSize
{
    protected array $filters;
    protected ?string $selectedLokasi;
    protected ?string $selectedRuangan;

    public function __construct(array $filters = [], ?string $selectedLokasi = null, ?string $selectedRuangan = null)
    {
        $this->filters = $filters;
        $this->selectedLokasi = $selectedLokasi;
        $this->selectedRuangan = $selectedRuangan;
    }

    public function view(): View
    {
        $query = Aset::with(['jenisBarang.klasifikasi', 'ruangan.lokasi']);

        if (!empty($this->filters['lokasi_id'])) {
            $query->whereHas('ruangan', fn($q) => $q->where('lokasi_id', $this->filters['lokasi_id']));
        }
        if (!empty($this->filters['ruangan_id'])) {
            $query->where('ruangan_id', $this->filters['ruangan_id']);
        }
        if (!empty($this->filters['klasifikasi_id'])) {
            $query->whereHas('jenisBarang', fn($q) => $q->where('klasifikasi_id', $this->filters['klasifikasi_id']));
        }
        if (!empty($this->filters['kondisi'])) {
            $query->where('kondisi', $this->filters['kondisi']);
        }
        if (!empty($this->filters['tahun_pembelian'])) {
            $query->where('tahun_pembelian', $this->filters['tahun_pembelian']);
        }

        $aset = $query->orderBy('kode_aset')->get();

        return view('laporan.excel', ['aset' => $aset]);
    }

    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $sheet = $event->sheet->getDelegate();

                // 1. Push data down 8 rows
                $sheet->insertNewRowBefore(1, 8);

                // 2. Logo placed AFTER row insertion at A1
                //    Logo original: 356x142px. At height=60, width ~150px.
                //    Column A = 23 units (~161px) → logo fits perfectly inside col A
                $logoPath = public_path('perumda.png');
                if (file_exists($logoPath)) {
                    $drawing = new Drawing();
                    $drawing->setName('Logo Perumda');
                    $drawing->setPath($logoPath);
                    $drawing->setResizeProportional(true);
                    $drawing->setHeight(60);
                    $drawing->setCoordinates('A1');
                    $drawing->setOffsetX(6);
                    $drawing->setOffsetY(20); // vertically centered in 4 kop rows
                    $drawing->setWorksheet($sheet);
                }

                // 3. Kop Surat text at column B — safe because logo (150px) fits in col A (161px)
                $sheet->setCellValue('B1', 'PERUSAHAAN UMUM DAERAH PASAR JOYOBOYO');
                $sheet->setCellValue('B2', 'PEMERINTAH KOTA KEDIRI');
                $sheet->setCellValue('B3', 'Jl. Brigadir Jenderal Polisi Imam Bahri No. 92, Kelurahan Bangsal, Kecamatan Pesantren, Kota Kediri 64131');
                $sheet->setCellValue('B4', 'Telp: (0354) 671212   Email: pasarjoyoboyokotakediri@gmail.com   Web: perumdapasarjoyoboyo.kedirikota.go.id');

                $reportTitle = 'LAPORAN INVENTARIS ASET';
                if ($this->selectedLokasi)
                    $reportTitle .= ' - ' . strtoupper($this->selectedLokasi);
                if ($this->selectedRuangan)
                    $reportTitle .= ' - ' . strtoupper($this->selectedRuangan);

                $sheet->setCellValue('A6', $reportTitle);
                $sheet->setCellValue('A7', 'Tanggal Cetak: ' . date('d/m/Y H:i'));

                // 4. Merge cells
                $sheet->mergeCells('B1:L1');
                $sheet->mergeCells('B2:L2');
                $sheet->mergeCells('B3:L3');
                $sheet->mergeCells('B4:L4');
                $sheet->mergeCells('A5:L5');
                $sheet->mergeCells('A6:L6');
                $sheet->mergeCells('A7:L7');
                $sheet->mergeCells('A8:L8');

                // 5. Column A fixed to contain logo; column B handled by ShouldAutoSize
                $sheet->getColumnDimension('A')->setAutoSize(false);
                $sheet->getColumnDimension('A')->setWidth(23); // ~161px, logo is 150px
    
                // Row heights
                $sheet->getRowDimension(1)->setRowHeight(20);
                $sheet->getRowDimension(2)->setRowHeight(26);
                $sheet->getRowDimension(3)->setRowHeight(15);
                $sheet->getRowDimension(4)->setRowHeight(15);
                $sheet->getRowDimension(5)->setRowHeight(8);
                $sheet->getRowDimension(6)->setRowHeight(20);
                $sheet->getRowDimension(7)->setRowHeight(15);
                $sheet->getRowDimension(8)->setRowHeight(6);

                // 6. Fonts & Colors
                $sheet->getStyle('B1')->getFont()->setName('Arial')->setSize(11)->setBold(true)->getColor()->setARGB('FF0B5EDD');
                $sheet->getStyle('B2')->getFont()->setName('Arial')->setSize(16)->setBold(true)->getColor()->setARGB('FF222222');
                $sheet->getStyle('B3:B4')->getFont()->setName('Arial')->setSize(9)->getColor()->setARGB('FF444444');

                // 7. Alignment
                $sheet->getStyle('B1:L4')->getAlignment()
                    ->setHorizontal(Alignment::HORIZONTAL_LEFT)
                    ->setVertical(Alignment::VERTICAL_CENTER);

                // 8. Border below Kop Surat
                $sheet->getStyle('A5:L5')->getBorders()->getBottom()->setBorderStyle(Border::BORDER_MEDIUM);

                // 9. Report title
                $sheet->getStyle('A6')->getFont()->setSize(13)->setBold(true)->setUnderline(true);
                $sheet->getStyle('A7')->getFont()->setSize(10);
                $sheet->getStyle('A6:L7')->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);

                // 10. Table header (row 9 after insert)
                $sheet->getStyle('A9:L9')->getFont()->setBold(true);
                $sheet->getStyle('A9:L9')->getFill()
                    ->setFillType(Fill::FILL_SOLID)
                    ->getStartColor()->setARGB('FFF1F5F9');
            },
        ];
    }
}