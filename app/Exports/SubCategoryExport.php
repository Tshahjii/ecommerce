<?php

namespace App\Exports;

use App\Models\SubCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithEvents;
use Maatwebsite\Excel\Events\AfterSheet;

class SubCategoryExport implements
    FromCollection,
    WithHeadings,
    WithMapping,
    ShouldAutoSize,
    WithEvents
{
    private $category;
    private $index = 1;

    public function __construct()
    {
        $this->category = SubCategory::with('childCategory')->orderBy('id', 'DESC')->get();
    }
    public function collection()
    {
        return $this->category;
    }
    public function headings(): array
    {
        return [
            'S.No.',
            'Sub-category Name',
            'Slug',
            'Child-category',
            'Status',
            'Created At',
            'Updated At',
        ];
    }
    public function map($category): array
    {
        return [
            $this->index++,
            $category->categories,
            $category->slug,
            $category->childCategory->child_category,
            $category->status,
            $category->created_at,
            $category->updated_at,
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
                $event->sheet->setCellValue('A1', 'Sub Category | Shahshop');
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
