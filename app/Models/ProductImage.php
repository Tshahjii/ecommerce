<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    protected $fillable = ['product_id', 'image_path', 'product_status', 'order_by'];
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
    public static function productImages($request)
    {
        $query = Product::whereHas('productImages') // only products with images
            ->with([
                'productImages:id,product_id,image_path,product_status,created_at'
            ]);

        if (!empty($request->product_name)) {
            $query->where(function ($q) use ($request) {
                $q->where('product_title', 'LIKE', '%' . $request->product_name . '%')
                    ->orWhere('product_status', $request->product_name);
            });
        }

        if (!empty($request->status)) {
            $query->whereHas('productImages', function ($q) use ($request) {
                $q->where('product_status', $request->status);
            });
        }

        if (!empty($request->dateTime)) {
            $query->whereHas('productImages', function ($q) use ($request) {
                $q->whereDate('created_at', $request->dateTime);
            });
        }

        $products = $query->orderByDesc('id')->get();
        $sn = 1;
        $data = [];
        foreach ($products as $product) {
            $latestImage = $product->productImages->sortByDesc('created_at')->first();
            if ($latestImage?->product_status === 'active') {
                $status = '<span class="badge bg-success">Active</span>';
            } elseif ($latestImage?->product_status === 'inactive') {
                $status = '<span class="badge bg-warning">Inactive</span>';
            } else {
                $status = '<span class="badge bg-danger">Suspended</span>';
            }
            $imagesHtml = '<div class="avatar-group">';
            foreach ($product->productImages as $img) {
                $imagePath = asset('backend/upload/image/product/' . $product->product_slug . '/' . $img->image_path);
                $imagesHtml .= '
                <a href="javascript:void(0);" class="avatar-group-item material-shadow" data-bs-toggle="tooltip" title="' . e($product->product_title) . '"><img src="' . $imagePath . '" class="rounded-circle avatar-xs"></a>';
            }
            $imagesHtml .= '</div>';
            $data[] = [
                'sn' => '<div class="text-center">' . $sn++ . '</div>',
                'product_name' => e($product->product_title),
                'images' => $imagesHtml,
                'status' => '<div class="text-center">' . $status . '</div>',
                'created_at' => $latestImage?->created_at?->format('d M, Y h:i A'),
                'action' => '
                            <div class="text-center">
                                <div class="hstack gap-3 flex-wrap">
                                    <a href="' . ($latestImage
                    ? route('update-products-images', ['id' => encrypt($latestImage->id)])
                    : '#') . '"
                                    class="link-success fs-15">
                                        <i class="ri-edit-2-line"></i>
                                    </a>

                                    <a href="' . ($latestImage
                    ? route('delete-products-image', ['id' => encrypt($latestImage->id)])
                    : '#') . '"
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
