<?php

namespace App\Imports;

use App\Models\SubCategory;
use App\Models\ChildCategory;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class SubCategoryImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    public function model(array $row)
    {
        $childCategoryId = ChildCategory::where('child_category', trim($row['child_category']))->value('id');
        if (!$childCategoryId) {
            return null;
        }
        return new SubCategory(['sub_category' => trim($row['sub_category']), 'slug' => trim($row['slug']), 'child_category_id' => $childCategoryId, 'status' => isset($row['status']) ? strtolower(trim($row['status'])) : 'active',]);
    }

    public function rules(): array
    {
        return [
            '*.sub_category'   => 'required|unique:sub_categories,sub_category',
            '*.slug'           => 'required|unique:sub_categories,slug',
            '*.child_category' => 'required|exists:child_categories,child_category',
        ];
    }

    public function customValidationMessages(): array
    {
        return [
            '*.sub_category.required'   => 'Sub category is required.',
            '*.sub_category.unique'     => 'Sub category already exists.',
            '*.slug.required'           => 'Slug is required.',
            '*.slug.unique'             => 'Slug already exists.',
            '*.child_category.required' => 'Child category is required.',
            '*.child_category.exists'   => 'Child category does not exist.',
        ];
    }
}
