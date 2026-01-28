<?php

namespace App\Http\Controllers\backend\site;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\ChildCategory;
use App\Models\SubCategory;
use App\Models\Brand;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        $count = Product::productCount();
        return view('backend.product.index', compact('count'));
    }
    public function create()
    {
        return view('backend.product.create');
    }
    public function update($id)
    {
        $product = Product::findOrFail(decrypt($id));
        return view('backend.product.update', compact('product'));
    }
    public function delete($id)
    {
        $product = Product::findOrFail(decrypt($id));
        $product->update(['product_status' => 'suspended']);
        return redirect()->back()->with('success', 'Product deleted successfully');
    }
    public function productImage()
    {
        return view('backend.product.product-image');
    }
    public function imageUpload()
    {
        return view('backend.product.image-upload');
    }
    public function category()
    {
        $category = Category::select('id', 'categories')->orderBy('id', 'DESC')->get();
        return response()->json(['status' => 'success', 'data' => $category]);
    }
    public function childCategory($id)
    {
        $child_category = ChildCategory::select('id', 'child_category')->where('category_id', $id)->orderBy('id', 'DESC')->get();
        return response()->json(['status' => 'success', 'data' => $child_category]);
    }
    public function subCategory($id)
    {
        $sub_category = SubCategory::select('id', 'sub_category')->where('child_category_id', $id)->orderBy('id', 'DESC')->get();
        return response()->json(['status' => 'success', 'data' => $sub_category]);
    }
    public function relatedProduct($id)
    {
        $related_product = Product::select('id', 'product_title')->where('sub_category', $id)->get();
        return response()->json(['status' => 'success', 'data' => $related_product]);
    }
    public function brands()
    {
        $brands = Brand::select('id', 'brands')->orderBy('id', 'DESC')->get();
        return response()->json(['status' => 'success', 'data' => $brands]);
    }
    public function getProduct()
    {
        $product = Product::select('id', 'product_title')->orderBy('id', 'DESC')->get();
        return response()->json(['status' => 'success', 'data' => $product]);
    }
    public function productType(Request $request)
    {
        $query = ChildCategory::select('id', 'child_category')->withCount('child_category');
        if ($request->product) {
            $query->where('child_category', 'LIKE', '%' . $request->product . '%');
        }
        $child_category = $query->orderBY('id', 'DESC')->get();
        return response()->json(['status' => 'success', 'data' => $child_category]);
    }
    public function brandsType(Request $request)
    {
        $query = Brand::select('id', 'brands')->withCount('brands_count');
        if ($request->brands) {
            $query->where('brands', 'LIKE', '%' . $request->brands . '%');
        }
        $brands = $query->orderBy('id', 'DESC')->get();
        return response()->json(['status' => 'success', 'data' => $brands]);
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_title'        => 'required|string|max:50',
            'product_slug'         => 'required|string|max:50|unique:products,product_slug',
            'description'          => 'nullable|string',
            'manufacturer_name'    => 'nullable|string|max:50',
            'manufacturer_brand'   => 'nullable|string|max:50',
            'stocks'               => 'nullable|integer|min:0',
            'product_price'        => 'required|numeric|min:0',
            'compare_price'        => 'required|numeric|min:0|gte:product_price',
            'product_discount'     => 'nullable|numeric|min:0|max:100',
            'is_featured'          => 'required|in:yes,no',
            'product_status'       => 'nullable|in:active,inactive,suspended',
            'meta_title'           => 'nullable|string|max:100',
            'meta_keywords'        => 'nullable|string|max:100',
            'meta_description'     => 'nullable|string|max:1000',
            'category'             => 'required|integer|exists:categories,id',
            'child_category'       => 'nullable|integer|exists:child_categories,id',
            'sub_category'         => 'nullable|integer|exists:sub_categories,id',
            'related_product'      => 'nullable|array',
            'related_product.*'    => 'integer|exists:products,id',
            'brands'               => 'nullable|integer|exists:brands,id',
            'barcodes'             => 'nullable|string|max:255',
            'released_date'        => 'required',
        ]);
        $validated['related_product'] = isset($validated['related_product']) ? implode(',', $validated['related_product']) : null;
        Product::create($validated);
        return redirect()->back()->with('success', 'Product added successfully');
    }
    public function updateProduct(Request $request)
    {
        $productId = decrypt($request->p_id);
        $validated = $request->validate([
            'product_title'        => 'required|string|max:50',
            'product_slug'         => 'required|string|max:50|unique:products,product_slug,' . $productId,
            'description'          => 'nullable|string',
            'manufacturer_name'    => 'nullable|string|max:50',
            'manufacturer_brand'   => 'nullable|string|max:50',
            'stocks'               => 'nullable|integer|min:0',
            'product_price'        => 'required|numeric|min:0',
            'compare_price'        => 'required|numeric|min:0|gte:product_price',
            'product_discount'     => 'nullable|numeric|min:0|max:100',
            'is_featured'          => 'required|in:yes,no',
            'product_status'       => 'nullable|in:active,inactive,suspended',
            'meta_title'           => 'nullable|string|max:100',
            'meta_keywords'        => 'nullable|string|max:100',
            'meta_description'     => 'nullable|string|max:1000',
            'category'             => 'required|integer|exists:categories,id',
            'child_category'       => 'nullable|integer|exists:child_categories,id',
            'sub_category'         => 'nullable|integer|exists:sub_categories,id',
            'related_product'      => 'nullable|array',
            'related_product.*'    => 'integer|exists:products,id',
            'brands'               => 'nullable|integer|exists:brands,id',
            'barcodes'             => 'nullable|string|max:255',
            'released_date'        => 'required|date',
        ]);
        $validated['related_product'] = isset($validated['related_product']) ? implode(',', $validated['related_product']) : null;
        $product = Product::findOrFail($productId);
        $product->update($validated);
        return redirect()->back()->with('success', 'Product updated successfully');
    }
    public function imageStore(Request $request)
    {
        $data = $request->validate([
            'product_id' => 'required|exists:products,id',
            'image_path' => 'required|array',
            'product_status' => 'nullable|in:active,inactive,suspended',
        ]);
        $product = Product::select('product_slug')->where('id', $data['product_id'])->firstOrFail();
        if ($request->hasFile('image_path')) {
            $path = public_path('backend/upload/image/product/' . $product->product_slug);
            if (!file_exists($path)) {
                mkdir($path, 0755, true);
            }
            $i = 1;
            foreach ($request->file('image_path') as $image) {
                $imgName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
                $image->move($path, $imgName);
                ProductImage::create([
                    'product_id'     => $data['product_id'],
                    'image_path'     => $imgName,
                    'product_status' => $data['product_status'] ?? 'active',
                    'order_by'       => $i,
                ]);
                $i++;
            }
        }
        return redirect()->route('product-image')->with('success', 'Product images uploaded successfully.');
    }
    public function updateImages(Request $request)
    {
        $data = $request->validate([
            'product_id'     => 'required|exists:products,id',
            'image_path'     => 'required|array',
            'image_path.*'   => 'image|mimes:jpg,jpeg,png,webp|max:2048',
            'product_status' => 'nullable|in:active,inactive,suspended',
        ]);
        $product = Product::select('product_slug')->where('id', $data['product_id'])->firstOrFail();
        $path = public_path('backend/upload/image/product/' . $product->product_slug);
        if (!is_dir($path)) {
            mkdir($path, 0755, true);
        }
        $existingImages = ProductImage::where('product_id', $data['product_id'])->orderBy('id')->get();
        $order = 1;
        foreach ($existingImages as $img) {
            $img->update(['order_by' => $order]);
            $order++;
        }
        foreach ($request->file('image_path') as $image) {
            $imgName = time() . '-' . uniqid() . '.' . $image->getClientOriginalExtension();
            $image->move($path, $imgName);
            ProductImage::create([
                'product_id'     => $data['product_id'],
                'image_path'     => $imgName,
                'product_status' => $data['product_status'] ?? 'active',
                'order_by'       => $order,
            ]);
            $order++;
        }
        return redirect()->route('product-image')->with('success', 'Product images updated successfully.');
    }
    public function updateProductImage($id)
    {
        $productImage = ProductImage::findOrFail(decrypt($id));
        $images = ProductImage::where('product_id', $productImage->product_id)->get();
        $product = Product::find($productImage->product_id);
        return view('backend.product.update-image', compact('product', 'productImage', 'images'));
    }
    public function deleteImages($id)
    {
        $image = ProductImage::findOrFail(decrypt($id));
        if (file_exists(public_path($image->image_path))) {
            unlink(public_path($image->image_path));
        }
        $image->delete();
        return redirect()->back()->with('success', 'Product Image deleted successfully');
    }
    public function showAllProduct(Request $request)
    {
        $data_provider = Product::allProduct($request);
        return response()->json(['status' => 'success', 'data' => $data_provider]);
    }
    public function showScheduleProduct(Request $request)
    {
        $data_provider = Product::scheduleProduct($request);
        return response()->json(['status' => 'success', 'data' => $data_provider]);
    }
    public function showPublishedProduct(Request $request)
    {
        $data_provider = Product::publishedProduct($request);
        return response()->json(['status' => 'success', 'data' => $data_provider]);
    }
    public function showDraftProduct(Request $request)
    {
        $data_provider = Product::draftProduct($request);
        return response()->json(['status' => 'success', 'data' => $data_provider]);
    }
    public function showProductImage(Request $request)
    {
        $data_provider = ProductImage::productImages($request);
        return response()->json(['status' => 'success', 'data' => $data_provider]);
    }
    public function deleteProductImage($id)
    {
        $product_image = ProductImage::findOrFail(decrypt($id));
        $all_images = ProductImage::where('product_id', $product_image->product_id)->get();
        foreach ($all_images as $image_record) {
            $images = json_decode($image_record->image_path, true);
            if (is_array($images)) {
                foreach ($images as $image) {
                    $path = public_path('backend/upload/image/product/' . $image_record->product->product_slug . '/' . $image);
                    if (file_exists($path)) {
                        unlink($path);
                    }
                }
            } else {
                $path = public_path('backend/upload/image/product/' . $image_record->product->product_slug . '/' . $image_record->image_path);
                if (file_exists($path)) {
                    unlink($path);
                }
            }
            $image_record->forceDelete();
        }

        return back()->with('success', 'All product images deleted successfully');
    }
}
