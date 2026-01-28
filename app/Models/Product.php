<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['product_title', 'product_slug', 'description', 'manufacturer_name', 'manufacturer_brand', 'stocks', 'product_price', 'compare_price', 'product_discount', 'is_featured', 'product_status', 'meta_title', 'meta_keywords', 'meta_description', 'category', 'child_category', 'sub_category', 'related_product', 'brands', 'barcodes', 'released_date'];
    protected $casts = [
        'released_date' => 'datetime',
    ];
    public static function productCount()
    {
        $today = now()->toDateString();
        return [
            'all_product' => self::whereIn('product_status', ['active', 'inactive'])->count(),
            'schedule' => self::whereIn('product_status', ['active', 'inactive'])->whereDate('released_date', '>', $today)->count(),
            'published' => self::whereIn('product_status', ['active', 'inactive'])->whereDate('released_date', '<', $today)->count(),
            'draft' => self::where('product_status', 'suspended')->count(),
        ];
    }
    public function productImages()
    {
        return $this->hasMany(ProductImage::class, 'product_id', 'id');
    }
    public function firstProductImage()
    {
        return $this->hasOne(ProductImage::class, 'product_id', 'id')
            ->orderBy('id', 'ASC');
    }
    public function productCategory()
    {
        return $this->belongsTo(ChildCategory::class, 'child_category', 'id');
    }
    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brands');
    }
    public static function allProduct($request)
    {
        $query = self::select('id', 'product_title', 'product_slug', 'product_status', 'stocks', 'product_price', 'compare_price', 'child_category', 'released_date')->with(['firstProductImage', 'productCategory']);
        if (!empty($request->product_name)) {
            $search = $request->product_name;
            $query->where(function ($q) use ($search) {
                $q->where('product_title', 'LIKE', "%{$search}%")
                    ->orWhere('product_slug', 'LIKE', "%{$search}%")
                    ->orWhere('manufacturer_name', 'LIKE', "%{$search}%");
            });
        }
        if (!empty($request->product_id)) {
            $query->where('child_category', $request->product_id);
        }
        if (isset($request->from_price, $request->to_price)) {
            $query->whereBetween('product_price', [$request->from_price, $request->to_price]);
        }

        if (!empty($request->brands)) {
            $brands = is_array($request->brands) ? $request->brands : explode(',', $request->brands);
            $query->whereIn('brands', $brands);
        }

        $products = $query->orderByDesc('id')->whereIn('product_status', ['active', 'inactive'])->get();

        $sn = 1;
        $data = [];

        foreach ($products as $value) {
            if ($value->product_status == 'active') {
                $status = '<span class="badge bg-primary-subtle text-primary"><i class="ri-checkbox-circle-line align-middle text-success"></i>Active</span>';
            } elseif ($value->product_status == 'inactive') {
                $status = '<span class="badge bg-warning-subtle text-warning"><i class="ri-eye-off-line align-middle text-warning"></i>In-active</span>';
            } else {
                $status = '<span class="badge bg-danger-subtle text-danger"><i class="ri-close-circle-line align-middle text-danger"></i>Suspended</span>';
            }
            $images = !empty($value->firstProductImage->image_path)
                ? asset('backend/upload/image/product/' . $value->product_slug . '/' . $value->firstProductImage->image_path)
                : asset('backend/assets/images/default_image.jpg');
            $data[] = [
                'sn' => '<div class="text-center">' . $sn++ . '</div>',
                'product_name' => '<div class="d-flex align-items-center justify-content-center text-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-sm bg-light rounded p-1">
                                               <img src="' . $images . '" class="img-fluid d-block" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fs-14 mb-1">
                                                <a href="#" class="text-body">' . $value->product_title . '</a>
                                            </h5>
                                            <p class="text-muted mb-0">
                                                Category :
                                                <span class="fw-medium">' . ($value->productCategory?->child_category ?? 'N/A') . '</span>
                                            </p>
                                        </div>
                                    </div>',
                'status' => '<div class="text-center">' . $status . '</div>',
                'stock' => '<div class="text-center">' . ($value->stocks ?? '-') . '</div>',
                'price' => '<div class="text-center">' . $value->product_price . '</div>',
                'order' => '<div class="text-center">-</div>',
                'rating' => '<div class="text-center">-</div>',
                'published' => '<div class="text-center">' .
                    \Carbon\Carbon::parse($value->released_date)->format('d M, Y h:i A') .
                    '</div>',
                'action' => '
                            <div class="text-center">
                                <div class="hstack gap-3 flex-wrap">
                                    <a href="' . route('update-products', ['id' => encrypt($value->id)]) . '"
                                    class="link-success fs-15 ">
                                        <i class="ri-edit-2-line"></i>
                                    </a>

                                    <a href="' . route('delete-products', ['id' => encrypt($value->id)]) . '"
                                    class="link-danger fs-15">
                                        <i class="ri-delete-bin-line"></i>
                                    </a>
                                </div>
                            </div>',

            ];
        }
        return $data;
    }
    public static function scheduleProduct($request)
    {
        $query = self::select('id', 'product_title', 'product_slug', 'product_status', 'stocks', 'product_price', 'compare_price', 'child_category', 'released_date')->with(['firstProductImage', 'productCategory']);
        if (!empty($request->product_name)) {
            $search = $request->product_name;
            $query->where(function ($q) use ($search) {
                $q->where('product_title', 'LIKE', "%{$search}%")
                    ->orWhere('product_slug', 'LIKE', "%{$search}%")
                    ->orWhere('manufacturer_name', 'LIKE', "%{$search}%");
            });
        }
        if (!empty($request->product_id)) {
            $query->where('child_category', $request->product_id);
        }
        if (isset($request->from_price, $request->to_price)) {
            $query->whereBetween('product_price', [$request->from_price, $request->to_price]);
        }

        if (!empty($request->brands)) {
            $brands = is_array($request->brands) ? $request->brands : explode(',', $request->brands);
            $query->whereIn('brands', $brands);
        }

        $products = $query->orderByDesc('id')->whereIn('product_status', ['active', 'inactive'])->whereDate('released_date', '>', now()->toDateString())->get();

        $sn = 1;
        $data = [];

        foreach ($products as $value) {
            if ($value->product_status == 'active') {
                $status = '<span class="badge bg-primary-subtle text-primary"><i class="ri-checkbox-circle-line align-middle text-success"></i>Active</span>';
            } elseif ($value->product_status == 'inactive') {
                $status = '<span class="badge bg-warning-subtle text-warning"><i class="ri-eye-off-line align-middle text-warning"></i>In-active</span>';
            } else {
                $status = '<span class="badge bg-danger-subtle text-danger"><i class="ri-close-circle-line align-middle text-danger"></i>Suspended</span>';
            }
            $images = !empty($value->firstProductImage->image_path)
                ? asset('backend/upload/image/product/' . $value->product_slug . '/' . $value->firstProductImage->image_path)
                : asset('backend/assets/images/default_image.jpg');
            $data[] = [
                'sn' => '<div class="text-center">' . $sn++ . '</div>',
                'product_name' => '<div class="d-flex align-items-center justify-content-center text-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-sm bg-light rounded p-1">
                                               <img src="' . $images . '" class="img-fluid d-block" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fs-14 mb-1">
                                                <a href="#" class="text-body">' . $value->product_title . '</a>
                                            </h5>
                                            <p class="text-muted mb-0">
                                                Category :
                                                <span class="fw-medium">' . ($value->productCategory?->child_category ?? 'N/A') . '</span>
                                            </p>
                                        </div>
                                    </div>',
                'status' => '<div class="text-center">' . $status . '</div>',
                'stock' => '<div class="text-center">' . ($value->stocks ?? '-') . '</div>',
                'price' => '<div class="text-center">' . $value->product_price . '</div>',
                'order' => '<div class="text-center">-</div>',
                'rating' => '<div class="text-center">-</div>',
                'published' => '<div class="text-center">' .
                    \Carbon\Carbon::parse($value->released_date)->format('d M, Y h:i A') .
                    '</div>',
                'action' => '
                            <div class="text-center">
                                <div class="hstack gap-3 flex-wrap">
                                    <a href="' . route('update-products', ['id' => encrypt($value->id)]) . '"
                                    class="link-success fs-15 ">
                                        <i class="ri-edit-2-line"></i>
                                    </a>

                                    <a href="' . route('delete-products', ['id' => encrypt($value->id)]) . '"
                                    class="link-danger fs-15">
                                        <i class="ri-delete-bin-line"></i>
                                    </a>
                                </div>
                            </div>',

            ];
        }
        return $data;
    }
    public static function publishedProduct($request)
    {
        $query = self::select('id', 'product_title', 'product_slug', 'product_status', 'stocks', 'product_price', 'compare_price', 'child_category', 'released_date')->with(['firstProductImage', 'productCategory']);
        if (!empty($request->product_name)) {
            $search = $request->product_name;
            $query->where(function ($q) use ($search) {
                $q->where('product_title', 'LIKE', "%{$search}%")
                    ->orWhere('product_slug', 'LIKE', "%{$search}%")
                    ->orWhere('manufacturer_name', 'LIKE', "%{$search}%");
            });
        }
        if (!empty($request->product_id)) {
            $query->where('child_category', $request->product_id);
        }
        if (isset($request->from_price, $request->to_price)) {
            $query->whereBetween('product_price', [$request->from_price, $request->to_price]);
        }

        if (!empty($request->brands)) {
            $brands = is_array($request->brands) ? $request->brands : explode(',', $request->brands);
            $query->whereIn('brands', $brands);
        }

        $products = $query->orderByDesc('id')->whereIn('product_status', ['active', 'inactive'])->whereDate('released_date', '<', now()->toDateString())->get();

        $sn = 1;
        $data = [];

        foreach ($products as $value) {
            if ($value->product_status == 'active') {
                $status = '<span class="badge bg-primary-subtle text-primary"><i class="ri-checkbox-circle-line align-middle text-success"></i>Active</span>';
            } elseif ($value->product_status == 'inactive') {
                $status = '<span class="badge bg-warning-subtle text-warning"><i class="ri-eye-off-line align-middle text-warning"></i>In-active</span>';
            } else {
                $status = '<span class="badge bg-danger-subtle text-danger"><i class="ri-close-circle-line align-middle text-danger"></i>Suspended</span>';
            }
            $images = !empty($value->firstProductImage->image_path)
                ? asset('backend/upload/image/product/' . $value->product_slug . '/' . $value->firstProductImage->image_path)
                : asset('backend/assets/images/default_image.jpg');
            $data[] = [
                'sn' => '<div class="text-center">' . $sn++ . '</div>',
                'product_name' => '<div class="d-flex align-items-center justify-content-center text-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-sm bg-light rounded p-1">
                                               <img src="' . $images . '" class="img-fluid d-block" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fs-14 mb-1">
                                                <a href="#" class="text-body">' . $value->product_title . '</a>
                                            </h5>
                                            <p class="text-muted mb-0">
                                                Category :
                                                <span class="fw-medium">' . ($value->productCategory?->child_category ?? 'N/A') . '</span>
                                            </p>
                                        </div>
                                    </div>',
                'status' => '<div class="text-center">' . $status . '</div>',
                'stock' => '<div class="text-center">' . ($value->stocks ?? '-') . '</div>',
                'price' => '<div class="text-center">' . $value->product_price . '</div>',
                'order' => '<div class="text-center">-</div>',
                'rating' => '<div class="text-center">-</div>',
                'published' => '<div class="text-center">' .
                    \Carbon\Carbon::parse($value->released_date)->format('d M, Y h:i A') .
                    '</div>',
                'action' => '
                            <div class="text-center">
                                <div class="hstack gap-3 flex-wrap">
                                    <a href="' . route('update-products', ['id' => encrypt($value->id)]) . '"
                                    class="link-success fs-15 ">
                                        <i class="ri-edit-2-line"></i>
                                    </a>

                                    <a href="' . route('delete-products', ['id' => encrypt($value->id)]) . '"
                                    class="link-danger fs-15">
                                        <i class="ri-delete-bin-line"></i>
                                    </a>
                                </div>
                            </div>',

            ];
        }
        return $data;
    }
    public static function draftProduct($request)
    {
        $query = self::select('id', 'product_title', 'product_slug', 'product_status', 'stocks', 'product_price', 'compare_price', 'child_category', 'released_date')->with(['firstProductImage', 'productCategory']);
        if (!empty($request->product_name)) {
            $search = $request->product_name;
            $query->where(function ($q) use ($search) {
                $q->where('product_title', 'LIKE', "%{$search}%")
                    ->orWhere('product_slug', 'LIKE', "%{$search}%")
                    ->orWhere('manufacturer_name', 'LIKE', "%{$search}%");
            });
        }
        if (!empty($request->product_id)) {
            $query->where('child_category', $request->product_id);
        }
        if (isset($request->from_price, $request->to_price)) {
            $query->whereBetween('product_price', [$request->from_price, $request->to_price]);
        }

        if (!empty($request->brands)) {
            $brands = is_array($request->brands) ? $request->brands : explode(',', $request->brands);
            $query->whereIn('brands', $brands);
        }

        $products = $query->orderByDesc('id')->where('product_status', 'suspended')->get();

        $sn = 1;
        $data = [];

        foreach ($products as $value) {
            if ($value->product_status == 'active') {
                $status = '<span class="badge bg-primary-subtle text-primary"><i class="ri-checkbox-circle-line align-middle text-success"></i>Active</span>';
            } elseif ($value->product_status == 'inactive') {
                $status = '<span class="badge bg-warning-subtle text-warning"><i class="ri-eye-off-line align-middle text-warning"></i>In-active</span>';
            } else {
                $status = '<span class="badge bg-danger-subtle text-danger"><i class="ri-close-circle-line align-middle text-danger"></i>Suspended</span>';
            }
            $images = !empty($value->firstProductImage->image_path)
                ? asset('backend/upload/image/product/' . $value->product_slug . '/' . $value->firstProductImage->image_path)
                : asset('backend/assets/images/default_image.jpg');
            $data[] = [
                'sn' => '<div class="text-center">' . $sn++ . '</div>',
                'product_name' => '<div class="d-flex align-items-center justify-content-center text-center">
                                        <div class="flex-shrink-0 me-3">
                                            <div class="avatar-sm bg-light rounded p-1">
                                               <img src="' . $images . '" class="img-fluid d-block" />
                                            </div>
                                        </div>
                                        <div class="flex-grow-1">
                                            <h5 class="fs-14 mb-1">
                                                <a href="#" class="text-body">' . $value->product_title . '</a>
                                            </h5>
                                            <p class="text-muted mb-0">
                                                Category :
                                                <span class="fw-medium">' . ($value->productCategory?->child_category ?? 'N/A') . '</span>
                                            </p>
                                        </div>
                                    </div>',
                'status' => '<div class="text-center">' . $status . '</div>',
                'stock' => '<div class="text-center">' . ($value->stocks ?? '-') . '</div>',
                'price' => '<div class="text-center">' . $value->product_price . '</div>',
                'order' => '<div class="text-center">-</div>',
                'rating' => '<div class="text-center">-</div>',
                'published' => '<div class="text-center">' .
                    \Carbon\Carbon::parse($value->released_date)->format('d M, Y h:i A') .
                    '</div>',
                'action' => '
                            <div class="text-center">
                                <div class="hstack gap-3 flex-wrap">
                                    <a href="' . route('update-products', ['id' => encrypt($value->id)]) . '"
                                    class="link-success fs-15 ">
                                        <i class="ri-edit-2-line"></i>
                                    </a>

                                    <a href="' . route('delete-products', ['id' => encrypt($value->id)]) . '"
                                    class="link-danger fs-15">
                                        <i class="ri-delete-bin-line"></i>
                                    </a>
                                </div>
                            </div>',

            ];
        }
        return $data;
    }
}
