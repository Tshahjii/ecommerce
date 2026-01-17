<?php

namespace App\Http\Controllers\backend\site;

use App\Exports\ChildCategoryExport;
use App\Http\Controllers\Controller;
use App\Imports\ChildCategoryImport;
use App\Models\Category;
use App\Models\ChildCategory;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ChildCategoryController extends Controller
{
    public function index()
    {
        $category_child = ChildCategory::with('category')->orderBy('id', 'DESC')->get();
        $category = Category::select('id', 'categories')->where('status', 'active')->orderBy('id', 'DESC')->get();
        return view('backend.child-category.index', compact('category_child', 'category'));
    }
    public function createChildCategories(Request $request)
    {
        $request->validate([
            'child_category' => 'required|string|unique:child_categories,child_category,' . $request->id,
            'slug'           => 'nullable|string',
            'category_id'    => 'nullable|integer',
            'img_path'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'status'         => 'nullable|in:active,inactive,suspended'
        ]);
        $data = ['child_category' => $request->child_category, 'slug' => $request->slug, 'category_id' => $request->category_id, 'status' => $request->status ?? 'active',];
        if ($request->hasFile('img_path')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->file('img_path')->getClientOriginalExtension();
            $request->file('img_path')->move(
                public_path('backend/upload/image/child-category'),
                $imageName
            );
            $data['img_path'] = $imageName;
        }
        ChildCategory::updateOrCreate(['id' => $request->id], $data);
        return back()->with('success', $request->id ? 'Child Category updated successfully!' : 'Child Category created successfully!');
    }
    public function deleteChildCategries($id)
    {
        $child_category = ChildCategory::findOrFail($id);
        $child_category->delete();
        return redirect()->back()->with('success', 'Child Category deleted successfully!');
    }
    public function getChildCategory($id)
    {
        $child_category = ChildCategory::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $child_category]);
    }
    public function bulkUpload()
    {
        return view('backend.child-category.bulk-upload');
    }
    public function downloadChildCategorySheet()
    {
        $pathToFile = public_path('backend/upload/download/childcategories.xlsx');
        $name = 'childcategories.xlsx';
        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        if (!file_exists($pathToFile)) {
            return back()->with('error', 'File not found.');
        }
        return response()->download($pathToFile, $name, $headers);
    }
    public function childCategoryBulkUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'categories' => 'required|mimes:xlsx,csv,txt',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Your sheet is not in correct format');
        }
        if ($request->hasFile('categories')) {
            $file = $request->file('categories');
            $file_name = time() . '_child_category.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('imports/child-category', $file_name, 'public');
            if (!$path) {
                return back()->with('error', 'File not stored!');
            }
            $fullPath = Storage::disk('public')->path($path);
            $import = new ChildCategoryImport();
            Excel::import($import, $fullPath);
            return redirect()->back()->with([
                'success' => 'Bulk upload completed',
                'failures' => $import->failures()
            ]);
        }
        return redirect()->back()->with('success', 'Bulk child categories uploaded successfully!');
    }
    public function downloadExcelChildCategory()
    {
        return Excel::download(new ChildCategoryExport, 'childcategories.xlsx');
    }
    public function downloadpdfChildCategory()
    {
        $data = ChildCategory::with('category')->orderBy('id', 'DESC')->get();
        $pdf = PDF::loadView('backend.pdf.child-category', compact('data'));
        return $pdf->download('childcategories.pdf');
    }
}
