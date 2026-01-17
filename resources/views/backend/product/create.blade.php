@extends('backend.layout.main')
@section('title', 'Create Products')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Create Product</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ri-home-8-line"></i>
                                Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('product') }}">Product</a></li>
                        <li class="breadcrumb-item active">Create Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @include('backend.alert.simple-alert')
    <form action="{{ route('new-product-add') }}" method="POST" autocomplete="off">
        @csrf
        <div class="row">
            <div class="col-lg-8">
                <div class="card">
                    <div class="card-body">
                        <div class="mb-3">
                            <label class="form-label" for="product_title">Product Title</label>
                            <input type="text" class="form-control @error('product_title') is-invalid @enderror"
                                id="product_title" name="product_title" placeholder="Enter product title">
                            @error('product_title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label class="form-label" for="product_slug">Product Slug</label>
                            <input type="text" class="form-control @error('product_slug') is-invalid @enderror"
                                id="product_slug" name="product_slug" placeholder="Enter product slug" readonly>
                            @error('product_slug')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div>
                            <label>Product Description</label>
                            <textarea name="description" id="ckeditor-classic" rows="10"></textarea>
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link active" data-bs-toggle="tab" href="#addproduct-general-info"
                                    role="tab">
                                    General Info
                                </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" data-bs-toggle="tab" href="#addproduct-metadata" role="tab">
                                    Meta Data
                                </a>
                            </li>
                        </ul>
                    </div>
                    <div class="card-body">
                        <div class="tab-content">
                            <div class="tab-pane active" id="addproduct-general-info" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer_name">Manufacturer
                                                Name</label>
                                            <input type="text"
                                                class="form-control @error('manufacturer_name') is-invalid @enderror"
                                                id="manufacturer_name" name="manufacturer_name"
                                                placeholder="Enter manufacturer name">
                                            @error('manufacturer_name')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="manufacturer_brand">Manufacturer
                                                Brand</label>
                                            <input type="text"
                                                class="form-control @error('manufacturer_brand') is-invalid @enderror"
                                                id="manufacturer_brand" name="manufacturer_brand"
                                                placeholder="Enter manufacturer brand">
                                            @error('manufacturer_brand')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                                <!-- end row -->

                                <div class="row">
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="stocks">Stocks</label>
                                            <input type="text" class="form-control @error('stocks') is-invalid @enderror"
                                                id="stocks" name="stocks" placeholder="Stocks">
                                            @error('stocks')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="product_price">Price</label>
                                            <div class="input-group has-validation mb-3">
                                                <span class="input-group-text" id="product-price-addon">₹</span>
                                                <input type="text"
                                                    class="form-control @error('product_price') is-invalid @enderror"
                                                    id="product_price" name="product_price" placeholder="Enter price"
                                                    aria-label="Price" aria-describedby="product-price-addon">
                                                @error('product_price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="compare_price">Compare Price</label>
                                            <div class="input-group has-validation mb-3">
                                                <span class="input-group-text" id="product-price-addon">₹</span>
                                                <input type="text"
                                                    class="form-control @error('compare_price') is-invalid @enderror"
                                                    id="compare_price" name="compare_price" placeholder="Enter price"
                                                    aria-label="Price" aria-describedby="product-price-addon">
                                                <span id="price_compare" class="invalid-feedback"></span>
                                                @error('compare_price')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-3 col-sm-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="product_discount">Discount</label>
                                            <div class="input-group mb-3">
                                                <span class="input-group-text" id="product-discount-addon">%</span>
                                                <input type="text"
                                                    class="form-control @error('product_discount') is-invalid @enderror"
                                                    id="product_discount" name="product_discount"
                                                    placeholder="Enter discount" aria-label="discount"
                                                    aria-describedby="product-discount-addon">
                                                @error('product_discount')
                                                    <div class="invalid-feedback">{{ $message }}</div>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="is_featured">Is Featured</label>
                                            <select class="form-control @error('is_featured') is-invalid @enderror"
                                                id="is_featured" name="is_featured">
                                                <option value="" selected>Is Featured</option>
                                                <option value="yes">Yes</option>
                                                <option value="no">No</option>
                                            </select>
                                            @error('is_featured')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-6 col-12">
                                        <div class="mb-3">
                                            <label class="form-label" for="product_status">Status</label>
                                            <select class="form-control @error('product_status') is-invalid @enderror"
                                                id="product_status" name="product_status">
                                                <option value="active" selected>Active</option>
                                                <option value="inactive">In-active</option>
                                                <option value="suspended">Suspended</option>
                                            </select>
                                            @error('product_status')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="tab-pane" id="addproduct-metadata" role="tabpanel">
                                <div class="row">
                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta_title">Meta title</label>
                                            <input type="text"
                                                class="form-control @error('meta_title') is-invalid @enderror"
                                                placeholder="Enter meta title" id="meta_title" name="meta_title">
                                            @error('meta_title')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                    <!-- end col -->

                                    <div class="col-lg-6">
                                        <div class="mb-3">
                                            <label class="form-label" for="meta_keywords">Meta Keywords</label>
                                            <input type="text"
                                                class="form-control @error('meta_keywords') is-invalid @enderror"
                                                placeholder="Enter meta keywords" id="meta_keywords"
                                                name="meta_keywords">
                                            @error('meta_keywords')
                                                <div class="invalid-feedback">{{ $message }}</div>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <label class="form-label" for="meta_description">Meta Description</label>
                                    <textarea class="form-control @error('meta_description') is-invalid @enderror" id="meta_description"
                                        name="meta_description" placeholder="Enter meta description" rows="3"></textarea>
                                    @error('meta_description')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-4">
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Category</h5>
                    </div>
                    <div class="card-body">
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="category" class="form-label mb-0">Category</label>
                                <a href="{{ route('category') }}" class="small">Add New</a>
                            </div>
                            <select class="js-example-basic-single @error('category') is-invalid @enderror"
                                name="category" id="category">
                                <option value="" selected>Category</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="child_category" class="form-label">Child-category</label>
                                <a href="{{ route('childcategory') }}" class="small">Add New</a>
                            </div>
                            <select class="js-example-basic-single @error('child_category') is-invalid @enderror"
                                id="child_category" name="child_category">
                                <option value="" selected>Child-category</option>
                            </select>
                            @error('child_category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div>
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="sub_category" class="form-label">Sub-category</label>
                                <a href="{{ route('subcategory') }}" class="small">Add New</a>
                            </div>
                            <select class="js-example-basic-single @error('sub_category') is-invalid @enderror"
                                id="sub_category" name="sub_category">
                                <option value="" selected>Sub-category</option>
                            </select>
                            @error('sub_category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Related Products & Brands</h5>
                    </div>
                    <!-- end card body -->
                    <div class="card-body">
                        <div class="mb-3">
                            <label for="related_product" class="form-label">Related Products</label>
                            <select class="js-example-basic-single @error('related_product') is-invalid @enderror"
                                id="related_product" name="related_product" multiple>
                                <option value="" selected>Related Products</option>
                            </select>
                            @error('related_product')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <div class="d-flex justify-content-between align-items-center mb-2">
                                <label for="brands" class="form-label">Brands</label>
                                <a href="{{ route('brands') }}" class="small">Add New</a>
                            </div>
                            <select class="js-example-basic-single @error('brands') is-invalid @enderror" id="brands"
                                name="brands">
                                <option value="" selected>Brands</option>
                            </select>
                            @error('brands')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="card">
                    <div class="card-header">
                        <h5 class="card-title mb-0">Product Barcode</h5>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-12 col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="barcodes">Barcode</label>
                                    <input type="text" class="form-control @error('barcodes') is-invalid @enderror"
                                        id="barcodes" name="barcodes" placeholder="Barcodes">
                                    @error('barcodes')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label class="form-label" for="released_date">Publish Date</label>
                                    <input type="datetime-local"
                                        class="form-control @error('released_date') is-invalid @enderror"
                                        id="released_date" name="released_date"
                                        value="{{ old('released_date', now()->format('Y-m-d\TH:i')) }}"
                                        min="{{ now()->format('Y-m-d\TH:i') }}">
                                    @error('released_date')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="text-end mb-3">
            <div class="d-flex gap-2">
                <button type="button" class="btn btn-info ms-3" data-bs-dismiss="modal">
                    Back
                </button>
                <button type="submit" class="btn btn-primary">
                    Submit
                </button>
            </div>
        </div>
    </form>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#category').select2();
            $('#child_category').select2();
            $('#sub_category').select2();
            $('#brands').select2();
            // Load Master Categories
            $.ajax({
                url: "{{ route('master-category') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    let category = $('#category');
                    category.empty();
                    category.append('<option value="" selected>Category</option>');
                    $.each(response.data, function(key, value) {
                        category.append(
                            '<option value="' + value.id + '">' + value.categories +
                            '</option>'
                        );
                    });
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert("Something went wrong!");
                }
            });

            // Load Child Categories
            $('#category').on('change', function() {
                let category_id = $(this).val();
                if (!category_id) return;
                let child_category = $('#child_category');
                child_category.empty();
                child_category.append('<option value="" selected>Child Category</option>');
                $.ajax({
                    url: "{{ route('master-child-category', ':id') }}".replace(':id', category_id),
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $.each(response.data, function(key, value) {
                            child_category.append(
                                '<option value="' + value.id + '">' + value
                                .child_category + '</option>'
                            );
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert("Something went wrong!");
                    }
                });
            });

            // Load Sub Categories
            $('#child_category').on('change', function() {
                let child_category_id = $(this).val();
                if (!child_category_id) return;
                let sub_category = $('#sub_category');
                sub_category.empty();
                sub_category.append('<option value="" selected>Sub-category</option>');
                $.ajax({
                    url: "{{ route('master-sub-category', ':id') }}".replace(':id',
                        child_category_id),
                    type: "GET",
                    dataType: "json",
                    success: function(response) {
                        $.each(response.data, function(key, value) {
                            sub_category.append(
                                '<option value="' + value.id + '">' + value
                                .sub_category + '</option>'
                            );
                        });
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                        alert('Something went wrong!');
                    }
                });
            });

            $.ajax({
                url: "{{ route('master-brands') }}",
                type: "GET",
                dataType: "json",
                success: function(response) {
                    let brands = $('#brands');
                    brands.empty();
                    brands.append('<option value="" selected>Brands</option>');
                    $.each(response.data, function(key, value) {
                        brands.append(
                            '<option value="' + value.id + '">' + value.brands +
                            '</option>'
                        );
                    });
                },
                error: function(xhr) {
                    console.error(xhr.responseText);
                    alert("Something went wrong!");
                }
            });
            $('#product_title').on('input', function() {
                let title = $(this).val();
                let ucfirst = title.toLowerCase().replace(/\b\w/g, function(char) {
                    return char.toUpperCase();
                });
                let slug = ucfirst.toLowerCase().trim().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '');
                $('#product_title').val(ucfirst);
                $('#product_slug').val(slug);
            });
            $('#compare_price').on('input', function() {
                let compare_price = parseFloat($(this).val()) || 0;
                let product_price = parseFloat($('#product_price').val()) || 0;

                if (compare_price && product_price && product_price >= compare_price) {
                    $(this).addClass('is-invalid');
                    $('#price_compare').text('Compare price must be greater than product price');
                } else {
                    $(this).removeClass('is-invalid');
                    $('#price_compare').text('');
                }
            });
        });
    </script>
@endsection
