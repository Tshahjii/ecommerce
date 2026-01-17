<?php

namespace App\Http\Controllers\backend\site;

use App\Exports\CategoryExport;
use App\Http\Controllers\Controller;
use App\Imports\CategoriesImport;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = Category::orderBy('id', 'DESC')->get();
        return view('backend.category.index', compact('categories'));
    }
    public function createCatgories(Request $request)
    {
        $request->validate([
            'categories' => 'required|string|unique:categories,categories,' . $request->id,
            'slug' => 'nullable|string',
            'status' => 'nullable'
        ]);
        Category::updateOrCreate(['id' => $request->id], ['categories' => $request->categories, 'slug' => $request->slug, 'status' => $request->status]);
        return back()->with('success', $request->id ? 'Category updated successfully!' : 'Category created successfully!');
    }
    public function deleteCategories($id)
    {
        $category = Category::findOrFail($id);
        $category->delete();
        return redirect()->back()->with('success', 'Category deleted successfully!');
    }
    public function getCategory($id)
    {
        $category = Category::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $category]);
    }
    public function bulkUpload()
    {
        return view('backend.category.bulk-upload');
    }
    public function downloadCategorySheet()
    {
        $pathToFile = public_path('backend/upload/download/categories.xlsx');
        $name = 'categories.xlsx';
        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        if (!file_exists($pathToFile)) {
            return back()->with('error', 'File not found.');
        }
        return response()->download($pathToFile, $name, $headers);
    }
    public function categoryBulkUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categories' => 'required|mimes:xlsx,csv,txt',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Your sheet is not in correct format');
        }
        if ($request->hasFile('categories')) {
            $file = $request->file('categories');
            $file_name = time() . '_category.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('imports/category', $file_name, 'public');
            if (!$path) {
                return back()->with('error', 'File not stored!');
            }
            $fullPath = Storage::disk('public')->path($path);
            $import = new CategoriesImport();
            Excel::import($import, $fullPath);
            return redirect()->back()->with([
                'success' => 'Bulk categories upload completed',
                'failures' => $import->failures()
            ]);
        }
        return redirect()->back()->with('success', 'Bulk categories uploaded successfully!');
    }
    public function downloadExcelCategory()
    {
        return Excel::download(new CategoryExport, 'categories.xlsx');
    }
    public function downloadpdfCategory()
    {
        $data = Category::select('categories', 'slug', 'status', 'created_at', 'updated_at')->orderBy('id', 'DESC')->get();
        $pdf = PDF::loadView('backend.pdf.category', ['data' => $data]);
        return $pdf->download('categories.pdf');
    }
}
