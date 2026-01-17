<?php

namespace App\Imports;

use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class CategoriesImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;
    public function model(array $row)
    {
        return new Category([
            'categories' => $row['categories'],
            'slug'       => $row['slug'],
        ]);
    }
    public function rules(): array
    {
        return [
            '*.categories' => 'required|unique:categories,categories',
            '*.slug'       => 'required|unique:categories,slug',
        ];
    }
    public function customValidationMessages()
    {
        return [
            '*.categories.unique' => 'The category or slug has already been taken.',
            '*.slug.unique'       => 'The category or slug has already been taken.',
        ];
    }
}
