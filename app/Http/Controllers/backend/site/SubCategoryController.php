<?php

namespace App\Http\Controllers\backend\site;

use App\Exports\SubCategoryExport;
use App\Http\Controllers\Controller;
use App\Imports\SubCategoryImport;
use App\Models\SubCategory;
use App\Models\ChildCategory;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class SubCategoryController extends Controller
{
    public function index()
    {
        $sub_category = SubCategory::with('childCategory')->orderBy('id', 'DESC')->get();
        $child_category = ChildCategory::select('id', 'child_category')->get();
        return view('backend.sub-category.index', compact('sub_category', 'child_category'));
    }
    public function createSubCategories(Request $request)
    {
        $request->validate([
            'sub_category' => 'required|string|unique:sub_categories,sub_category,' . $request->id,
            'slug'           => 'nullable|string',
            'category_id'    => 'nullable|integer',
            'img_path'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'status'         => 'nullable|in:active,inactive,suspended'
        ]);
        $data = ['sub_category' => $request->sub_category, 'slug' => $request->slug, 'child_category_id' => $request->category_id, 'status' => $request->status ?? 'active',];
        if ($request->hasFile('img_path')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->file('img_path')->getClientOriginalExtension();
            $request->file('img_path')->move(
                public_path('backend/upload/image/sub-category'),
                $imageName
            );
            $data['img_path'] = $imageName;
        }
        SubCategory::updateOrCreate(['id' => $request->id], $data);
        return back()->with('success', $request->id ? 'Sub Category updated successfully!' : 'Sub Category created successfully!');
    }
    public function deleteSubcategries($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        $sub_category->delete();
        return redirect()->back()->with('success', 'Sub Category deleted successfully!');
    }
    public function getSubcategory($id)
    {
        $sub_category = SubCategory::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $sub_category]);
    }
    public function bulkUpload()
    {
        return view('backend.sub-category.bulk-upload');
    }
    public function downloadSubCategorySheet()
    {
        $pathToFile = public_path('backend/upload/download/subcategories.xlsx');
        $name = 'subcategories.xlsx';
        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        if (!file_exists($pathToFile)) {
            return back()->with('error', 'File not found.');
        }
        return response()->download($pathToFile, $name, $headers);
    }
    public function subCategoryBulkUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categories' => 'required|mimes:xlsx,csv,txt',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Your sheet is not in correct format');
        }
        if ($request->hasFile('categories')) {
            $file = $request->file('categories');
            $file_name = time() . '_sub_category.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('imports/sub-category', $file_name, 'public');
            if (!$path) {
                return back()->with('error', 'File not stored!');
            }
            $fullPath = Storage::disk('public')->path($path);
            $import = new SubCategoryImport();
            Excel::import($import, $fullPath);
            return redirect()->back()->with([
                'success' => 'Bulk sub categories upload completed',
                'failures' => $import->failures()
            ]);
        }
        return redirect()->back()->with('success', 'Bulk sub categories uploaded successfully!');
    }
    public function downloadExcelSubCategory()
    {
        return Excel::download(new SubCategoryExport, 'subcategories.xlsx');
    }
    public function downloadpdfSubCategory()
    {
        $data = SubCategory::with('childCategory')->orderBy('id', 'DESC')->get();
        $pdf = PDF::loadView('backend.pdf.sub-category', compact('data'));
        return $pdf->download('subcategories.pdf');
    }
}
