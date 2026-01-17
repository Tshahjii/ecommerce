<?php

namespace App\Exports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class BrandsExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithEvents
{
    private $brands;
    private $index = 1;

    public function __construct()
    {
        $this->brands = Brand::orderBy('id', 'DESC')->get();
    }
    public function collection()
    {
        return $this->brands;
    }
    public function headings(): array
    {
        return [
            'S.No.',
            'Brand Name',
            'Slug',
            'Status',
            'Created At',
            'Updated At',
        ];
    }
    public function map($brands): array
    {
        return [
            $this->index++,
            $brands->brands,
            $brands->slug,
            $brands->status,
            $brands->created_at,
            $brands->updated_at,
        ];
    }
    public function registerEvents(): array
    {
        return [
            AfterSheet::class => function (AfterSheet $event) {
                $totalColumns = count($this->headings());
                $lastColumn = chr(64 + $totalColumns);
                $event->sheet->insertNewRowBefore(1, 1);
                $event->sheet->mergeCells("A1:{$lastColumn}1");
                $event->sheet->setCellValue('A1', 'Brands | Shahshop');
                $event->sheet->getStyle("A1")->applyFromArray([
                    'font' => [
                        'bold' => true,
                        'size' => 14,
                    ],
                    'alignment' => [
                        'horizontal' => 'center',
                        'vertical'   => 'center',
                    ],
                ]);
            }
        ];
    }
}
