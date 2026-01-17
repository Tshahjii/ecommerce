<?php

namespace App\Imports;

use App\Models\Brand;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class BrandsImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;
    public function model(array $row)
    {
        return new Brand([
            'brands' => $row['brands'],
            'slug'       => $row['slug'],
            'status' => isset($row['status']) ? strtolower($row['status']) : 'active',
        ]);
    }
    public function rules(): array
    {
        return [
            '*.brands' => 'required|unique:brands,brands',
            '*.slug'       => 'required|unique:brands,slug',
        ];
    }
    public function customValidationMessages()
    {
        return [
            '*.brands.required' => 'Brands is required.',
            '*.brands.unique' => 'Brands already exists.',
            '*.slug.required' => 'Slug is required.',
            '*.slug.unique' => 'Slug already exists.',
        ];
    }
}
