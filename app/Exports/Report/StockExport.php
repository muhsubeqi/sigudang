<?php

namespace App\Exports\Report;

use App\Models\Item;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class StockExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    protected $stock;
    public function __construct($stock)
    {
        $this->stock = $stock;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        return Item::with('type', 'unit')
            ->when($this->stock == 'Minimum', function ($query) {
                $query->where('stock', '0');
            })->get();
    }

    public function headings(): array
    {
        return [
            [
                'Laporan Stok ' . $this->stock . ' Barang',
            ],
            [
                '',
            ],
            [
                'No',
                'Kode Barang',
                'Nama',
                'Jenis',
                'Stok',
                'Satuan',
            ],
        ];
    }

    public function map($row): array
    {
        static $rowNumber = 0;
        $rowNumber++;
        return [
            $rowNumber,
            $row['code'],
            $row['name'],
            $row['type']['name'],
            $row['stock'] == 0 ? '0' : $row['stock'],
            $row['unit']['name'],
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 15,
            'C' => 25,
            'D' => 20,
            'E' => 10,
            'F' => 15,
        ];
    }

    public function styles(Worksheet $sheet)
    {
        $sheet->mergeCells('A1:F1');
        $sheet->mergeCells('A2:F2');

        // Gaya untuk header
        return [
            '1' => [
                'font' => [
                    'bold' => true,
                    'size' => 14,
                    'uppercase' => true,
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            'A' => [
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
            '3' => [
                'font' => [
                    'bold' => true,
                    'color' => [
                        'argb' => 'FFFFFF'
                    ],
                ],
                'fill' => [
                    'fillType' => \PhpOffice\PhpSpreadsheet\Style\Fill::FILL_SOLID,
                    'startColor' => [
                        'argb' => '2356D7'
                    ],
                ],
                'alignment' => [
                    'horizontal' => Alignment::HORIZONTAL_CENTER,
                    'vertical' => Alignment::VERTICAL_CENTER,
                ],
            ],
        ];
    }
}