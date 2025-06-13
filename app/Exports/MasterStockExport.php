<?php
namespace App\Exports;

use App\Models\MasterStock;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class MasterStockExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return MasterStock::select([
            'kode_barang',
            'nama_barang',
            'f',
            'satuan',
            'qty_awal',
            'qty_akhir',
            'satuan_harga',
            'total'
        ])->get();
    }

    public function headings(): array
    {
        return [
            'Kode Barang',
            'Nama Barang',
            'F',
            'Satuan',
            'Qty Awal',
            'Qty Akhir',
            'Harga per Satuan',
            'Total'
        ];
    }

    // Tambahkan styling untuk header
    public function styles(Worksheet $sheet)
    {
        // Styling header (baris 1)
        $sheet->getStyle('A1:H1')->applyFromArray([
            'font' => [
                'bold' => true,
                'color' => ['rgb' => 'FFFFFF'],
            ],
            'fill' => [
                'fillType' => 'solid',
                'startColor' => ['rgb' => '52C4D5'],
            ],
            'alignment' => [
                'horizontal' => 'center',
            ],
        ]);
        // Optional: border untuk semua kolom
        $sheet->getStyle('A1:H' . ($sheet->getHighestRow()))
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [];
    }
}