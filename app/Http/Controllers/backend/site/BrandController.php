<?php

namespace App\Http\Controllers\backend\site;

use App\Exports\BrandsExport;
use App\Http\Controllers\Controller;
use App\Imports\BrandsImport;
use App\Models\Brand;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Facades\Excel;
use Barryvdh\DomPDF\Facade\PDF;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    public function index()
    {
        $brands = Brand::orderBy('id', 'DESC')->get();
        return view('backend.brand.index', compact('brands'));
    }
    public function createBrands(Request $request)
    {
        $request->validate([
            'brands' => 'required|string|unique:brands,brands,' . $request->id,
            'slug'           => 'nullable|string',
            'img_path'       => 'nullable|image|mimes:jpg,jpeg,png,webp',
            'status'         => 'nullable|in:active,inactive,suspended'
        ]);
        $data = ['brands' => $request->brands, 'slug' => $request->slug, 'status' => $request->status ?? 'active',];

        if ($request->hasFile('img_path')) {
            $imageName = time() . '_' . uniqid() . '.' . $request->file('img_path')->getClientOriginalExtension();
            $request->file('img_path')->move(
                public_path('backend/upload/image/brands'),
                $imageName
            );
            $data['img_path'] = $imageName;
        }
        Brand::updateOrCreate(['id' => $request->id], $data);
        return back()->with('success', $request->id ? 'Brands updated successfully!' : 'Brands created successfully!');
    }
    public function deleteBrands($id)
    {
        $brands = Brand::findOrFail($id);
        $brands->delete();
        return redirect()->back()->with('success', 'Brands deleted successfully!');
    }
    public function getBrands($id)
    {
        $brands = Brand::findOrFail($id);
        return response()->json(['status' => 'success', 'data' => $brands]);
    }
    public function bulkUpload()
    {
        return view('backend.brand.bulk-upload');
    }
    public function downloadBrandSheet()
    {
        $pathToFile = public_path('backend/upload/download/brands.xlsx');
        $name = 'brands.xlsx';
        $headers = ['Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet'];
        if (!file_exists($pathToFile)) {
            return back()->with('error', 'File not found.');
        }
        return response()->download($pathToFile, $name, $headers);
    }
    public function brandsBulkUpload(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'brands' => 'required|mimes:xlsx,csv,txt',
        ]);
        if ($validator->fails()) {
            return redirect()->back()->with('error', 'Your sheet is not in correct format');
        }
        if ($request->hasFile('brands')) {
            $file = $request->file('brands');
            $file_name = time() . '_brands.' . $file->getClientOriginalExtension();
            $path = $file->storeAs('imports/brands', $file_name, 'public');
            if (!$path) {
                return back()->with('error', 'File not stored!');
            }
            $fullPath = Storage::disk('public')->path($path);
            $import = new BrandsImport();
            Excel::import($import, $fullPath);
            return redirect()->back()->with([
                'success' => 'Bulk upload completed',
                'failures' => $import->failures()
            ]);
        }
        return redirect()->back()->with('success', 'Bulk brands uploaded successfully!');
    }
    public function downloadExcelBrands()
    {
        return Excel::download(new BrandsExport, 'brands.xlsx');
    }
    public function downloadPdfBrands()
    {
        $data = Brand::orderBy('id', 'DESC')->get();
        $pdf = PDF::loadView('backend.pdf.brands', compact('data'));
        return $pdf->download('brands.pdf');
    }
}
