<?php

namespace App\Exports\Report;

use App\Models\ItemTransaction;
use Carbon\Carbon;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithStyles;
use Maatwebsite\Excel\Concerns\WithColumnWidths;
use PhpOffice\PhpSpreadsheet\Style\Alignment;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;

class ItemTransactionExport implements FromCollection, WithHeadings, WithMapping, WithColumnWidths, WithStyles
{
    protected $status;
    protected $startDate;
    protected $endDate;
    public function __construct($status, $startDate, $endDate)
    {
        $this->status = $status;
        $this->startDate = $startDate;
        $this->endDate = $endDate;
    }
    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection()
    {
        $status = $this->status;
        $startDate = $this->startDate;
        $endDate = $this->endDate;
        $data = ItemTransaction::with('item')
            ->whereBetween('date', [$startDate, $endDate])
            ->when($status == 'in', function ($query) {
                $query->where('status', 'in');
            })
            ->when($status == 'out', function ($query) {
                $query->where('status', 'out');
            })
            ->get();
        return $data;
    }

    public function headings(): array
    {
        $status = $this->status == 'in' ? 'Masuk' : 'Keluar';
        return [
            [
                'Laporan Data Barang ' . $status
            ],
            [
                'Tanggal ' . Carbon::parse($this->startDate)->format('d-m-Y') . ' s/d ' . Carbon::parse($this->endDate)->format('d-m-Y'),
            ],
            [
                'No',
                'ID Transaksi',
                'Tanggal',
                'Barang',
                'Jumlah',
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
            $row['invoice'],
            $row['date'] != null ? Carbon::parse($row['date'])->format('d-m-Y') : '-',
            $row['item']['code'] . ' - ' . $row['item']['name'],
            $row['qty'] == 0 ? '0' : $row['qty'],
            $row['item']['unit']['name'] != null ? $row['item']['unit']['name'] : '-',
        ];
    }

    public function columnWidths(): array
    {
        return [
            'A' => 10,
            'B' => 15,
            'C' => 20,
            'D' => 25,
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
            '2' => [
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