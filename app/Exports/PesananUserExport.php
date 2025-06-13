<?php

namespace App\Exports;

use App\Models\PesananUser;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithStyles;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class PesananUserExport implements FromCollection, WithHeadings, WithStyles
{
    public function collection()
    {
        return PesananUser::select([
            'id',
            'user_id',
            'kode_barang',
            'nama_barang',
            'tanggal',
            'f',
            'satuan',
            'jumlah_qty',
            'tipe_transaksi',
            'no_surat',
            'jenis_surat',
            'status_surat',
            'supplier',
            'keterangan',
        ])
        ->get();
            
    }

    public function headings(): array
    {
        return [
            'ID',
            'User ID',
            'Kode Barang',
            'Nama Barang',
            'Tanggal',
            'F',
            'Satuan',
            'Jumlah Qty',
            'Tipe Transaksi',
            'No Surat',
            'Jenis Surat',
            'Status Surat',
            'Supplier',
            'Keterangan',
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->getStyle('A1:N1')->applyFromArray([
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
        $sheet->getStyle('A1:N' . ($sheet->getHighestRow()))
            ->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);

        return [];
    }
}