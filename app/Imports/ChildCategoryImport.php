<?php

namespace App\Imports;

use App\Models\ChildCategory;
use App\Models\Category;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;

class ChildCategoryImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use SkipsFailures;

    /**
     * Each row processing
     */
    public function model(array $row)
    {
        $categoryId = Category::where('categories', trim($row['category']))->value('id');
        if (!$categoryId) {
            return null;
        }
        return new ChildCategory(['child_category' => trim($row['child_category']), 'slug' => $row['slug'], 'category_id' => $categoryId, 'status' => isset($row['status']) ? strtolower($row['status']) : 'active',]);
    }

    /**
     * Validation rules
     */
    public function rules(): array
    {
        return [
            '*.child_category' => 'required|unique:child_categories,child_category',
            '*.slug' => 'required|unique:child_categories,slug',
            '*.category' => 'required',
        ];
    }

    /**
     * Custom validation messages
     */
    public function customValidationMessages()
    {
        return [
            '*.child_category.required' => 'Child category is required.',
            '*.child_category.unique' => 'Child category already exists.',
            '*.slug.required' => 'Slug is required.',
            '*.slug.unique' => 'Slug already exists.',
            '*.category.required' => 'Parent category is required.',
        ];
    }
}
