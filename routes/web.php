<?php

use App\Http\Controllers\backend\site\BrandController;
use App\Http\Controllers\backend\site\ChildCategoryController;
use App\Http\Controllers\backend\site\CategoryController;
use App\Http\Controllers\backend\site\DashboardController;
use App\Http\Controllers\backend\site\ProductController;
use App\Http\Controllers\backend\site\SubCategoryController;
use App\Http\Controllers\frontend\site\AuthController;
use App\Http\Controllers\frontend\site\CheckoutController;
use App\Http\Controllers\frontend\site\IndexController;
use App\Http\Controllers\frontend\site\ProductDetailController;
use App\Http\Controllers\frontend\site\ShopPageController;
use App\Http\Middleware\AuthMiddleware;
use FontLib\Table\Type\name;
use Illuminate\Support\Facades\Route;

Route::get('/', [IndexController::class, 'index'])->name('home-page');
Route::get('/product-detail', [ProductDetailController::class, 'productDetail'])->name('product-detail');
Route::get('/shop-page', [ShopPageController::class, 'shopPage'])->name('shop-page');
Route::get('/shop-full-page', [ShopPageController::class, 'shopFullPage'])->name('shop-full-page');
Route::get('/checkout', [CheckoutController::class, 'checkout'])->name('checkout');

Route::get('/sign-in', [AuthController::class, 'signIn'])->name('sign-in');
Route::get('/check-account/{ctry}/{mbl}', [AuthController::class, 'checkAccount'])->name('check-account');
Route::get('/sign-up/{ctry}/{mbl}', [AuthController::class, 'signUp'])->name('sign-up');
Route::get('/verify-number/{ctry}/{mbl}/{token}', [AuthController::class, 'verifyNumber'])->name('verify-number');
Route::get('/resend-otp/{ctry}/{mbl}/{token}', [AuthController::class, 'resendOtp'])->name('resend-otp');
Route::get('/send-otp-in-whatsapp/{ctry}/{mbl}/{token}', [AuthController::class, 'sendOtpInWhatsapp'])->name('send-otp-in-whatsapp');
Route::get('/password/{ctry}/{mbl}/{token}', [AuthController::class, 'password'])->name('password');
Route::get('/user-verified-by-otp/{ctry}/{mbl}/{token}', [AuthController::class, 'userVerifiedByOtp'])->name('user-verified-by-otp');
Route::post('/sign-up-data', [AuthController::class, 'signUpData'])->name('sign-up-data');
Route::post('/sign-in-data', [AuthController::class, 'signInData'])->name('sign-in-data');
Route::post('/verify-otp', [AuthController::class, 'verifyOtp'])->name('verify-otp');
Route::post('/user-verify-otp', [AuthController::class, 'userVerifyOtp'])->name('user-verify-otp');
Route::post('/user-verify-password', [AuthController::class, 'userVerifyPassword'])->name('user-verify-password');
Route::middleware([AuthMiddleware::class])->group(function () {
    Route::prefix('admin')->group(function () {
        Route::get('/', [DashboardController::class, 'dashboard'])->name('dashboard');
        Route::redirect('/dashboard', '/admin');

        Route::get('/master-category/index', [CategoryController::class, 'index'])->name('category');
        Route::get('/master-category/get-category/{id}', [CategoryController::class, 'getCategory'])->name('get-category');
        Route::get('/master-category/delete/{id}', [CategoryController::class, 'deleteCategories'])->name('delete-category');
        Route::get('/master-category/bulk-upload', [CategoryController::class, 'bulkUpload'])->name('category-bulkupload');
        Route::get('/master-category/download-sheet', [CategoryController::class, 'downloadCategorySheet'])->name('category-sheet');
        Route::get('/master-category/category-excel', [CategoryController::class, 'downloadExcelCategory'])->name('category-excel');
        Route::get('/master-category/category-pdf', [CategoryController::class, 'downloadpdfCategory'])->name('category-pdf');
        Route::post('/create-category', [CategoryController::class, 'createCatgories'])->name('create-category');
        Route::post('/category-bulkupload', [CategoryController::class, 'categoryBulkUpload'])->name('category-bulk-upload');

        Route::get('/master-child-category/index', [ChildCategoryController::class, 'index'])->name('childcategory');
        Route::get('/master-child-category/get-child-category/{id}', [ChildCategoryController::class, 'getChildCategory'])->name('get-child-category');
        Route::get('/master-child-category/delete/{id}', [ChildCategoryController::class, 'deleteChildCategries'])->name('delete-child-category');
        Route::get('/master-child-category/bulk-upload', [ChildCategoryController::class, 'bulkUpload'])->name('childcategory-bulkupload');
        Route::get('/master-child-category/download-sheet', [ChildCategoryController::class, 'downloadChildCategorySheet'])->name('childcategory-sheet');
        Route::get('/master-child-category/child-category-excel', [ChildCategoryController::class, 'downloadExcelChildCategory'])->name('child-category-excel');
        Route::get('/master-child-category/child-category-pdf', [ChildCategoryController::class, 'downloadpdfChildCategory'])->name('child-category-pdf');
        Route::post('/create-child-category', [ChildCategoryController::class, 'createChildCategories'])->name('create-child-category');
        Route::post('/childcategory-bulkupload', [ChildCategoryController::class, 'childCategoryBulkUpload'])->name('childcategory-bulk-upload');

        Route::get('/master-sub-category/index', [SubCategoryController::class, 'index'])->name('subcategory');
        Route::get('/master-sub-category/get-sub-category/{id}', [SubCategoryController::class, 'getSubcategory'])->name('get-sub-category');
        Route::get('/master-sub-category/delete/{id}', [SubCategoryController::class, 'deleteSubcategries'])->name('delete-sub-category');
        Route::get('/master-sub-category/bulk-upload', [SubCategoryController::class, 'bulkUpload'])->name('subcategory-bulkupload');
        Route::get('/master-sub-category/download-sheet', [SubCategoryController::class, 'downloadSubCategorySheet'])->name('subcategory-sheet');
        Route::get('/master-sub-category/sub-category-excel', [SubCategoryController::class, 'downloadExcelSubCategory'])->name('sub-category-excel');
        Route::get('/master-sub-category/sub-category-pdf', [SubCategoryController::class, 'downloadpdfSubCategory'])->name('sub-category-pdf');
        Route::post('/create-sub-category', [SubCategoryController::class, 'createSubCategories'])->name('create-sub-category');
        Route::post('/subcategory-bulkupload', [SubCategoryController::class, 'subCategoryBulkUpload'])->name('subcategory-bulk-upload');

        Route::get('/master-brands/index', [BrandController::class, 'index'])->name('brands');
        Route::get('/master-brands/get-brands/{id}', [BrandController::class, 'getBrands'])->name('get-brands');
        Route::get('/master-brands/delete/{id}', [BrandController::class, 'deleteBrands'])->name('delete-brands');
        Route::get('/master-brands/bulk-upload', [BrandController::class, 'bulkUpload'])->name('brands-bulkupload');
        Route::get('/master-brands/download-sheet', [BrandController::class, 'downloadBrandSheet'])->name('brands-sheet');
        Route::get('master-brands/brands-excel', [BrandController::class, 'downloadExcelBrands'])->name('brands-excel');
        Route::get('master-brands/brands-pdf', [BrandController::class, 'downloadPdfBrands'])->name('brands-pdf');
        Route::post('/create-brands', [BrandController::class, 'createBrands'])->name('create-brands');
        Route::post('/brands-bulk-upload', [BrandController::class, 'brandsBulkUpload'])->name('brands-bulk-upload');

        Route::get('/master-product/index', [ProductController::class, 'index'])->name('product');
        Route::get('/master-product/create', [ProductController::class, 'create'])->name('create-product');
        Route::get('/master-product/update-products/{id}', [ProductController::class, 'update'])->name('update-products');
        Route::get('/master-product/delete-products/{id}', [ProductController::class, 'delete'])->name('delete-products');
        Route::get('/master-product/product-image', [ProductController::class, 'productImage'])->name('product-image');
        Route::get('/master-product/create-product-image', [ProductController::class, 'imageUpload'])->name('create-product-image');
        Route::get('/master-product/update-products-images/{id}', [ProductController::class, 'updateProductImage'])->name('update-products-images');
        Route::get('/master-product/master-category', [ProductController::class, 'category'])->name('master-category');
        Route::get('/master-product/master-child-category/{id}', [ProductController::class, 'childCategory'])->name('master-child-category');
        Route::get('/master-product/master-sub-category/{id}', [ProductController::class, 'subCategory'])->name('master-sub-category');
        Route::get('/master-product/master-brands', [ProductController::class, 'brands'])->name('master-brands');
        Route::get('/master-product/get-product', [ProductController::class, 'getProduct'])->name('get-product');
        Route::get('/master-product/delete-products-image/{id}', [ProductController::class, 'deleteProductImage'])->name('delete-products-image');
        Route::post('/master-product/master-product-type', [ProductController::class, 'productType'])->name('typeof-product-list');
        Route::post('/master-product/master-brand-type', [ProductController::class, 'brandsType'])->name('typeof-brands-list');
        Route::post('/new-product-add', [ProductController::class, 'store'])->name('new-product-add');
        Route::post('/update-product', [ProductController::class, 'updateProduct'])->name('update-product');
        Route::post('/product-image-add', [ProductController::class, 'imageStore'])->name('product-image-add');
        Route::post('/product-image-update', [ProductController::class, 'updateImages'])->name('product-image-update');
        Route::post('/show-all-products', [ProductController::class, 'showAllProduct'])->name('show-all-products');
        Route::post('/show-schedule-products', [ProductController::class, 'showScheduleProduct'])->name('show-schedule-products');
        Route::post('/show-publish-products', [ProductController::class, 'showPublishedProduct'])->name('show-publish-products');
        Route::post('/show-draft-products', [ProductController::class, 'showDraftProduct'])->name('show-draft-products');
        Route::post('/show-products-image', [ProductController::class, 'showProductImage'])->name('show-products-image');
        Route::delete('product-image-delete/{id}', [ProductController::class, 'deleteImages'])->name('product-image-delete');

        Route::get('/logout', [AuthController::class, 'logout'])->name('logout');
    });
});
