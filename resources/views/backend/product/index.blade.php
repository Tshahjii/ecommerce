@extends('backend.layout.main')
@section('title', 'Product')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Product</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ri-home-8-line"></i>
                                Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Product</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @include('backend.alert.simple-alert')
    <div class="row">
        <div class="col-xl-3 col-lg-4">
            <div class="card">
                <div class="card-header">
                    <div class="d-flex mb-3">
                        <div class="flex-grow-1">
                            <h5 class="fs-16">Filters</h5>
                        </div>
                        <div class="flex-shrink-0">
                            <a href="#" class="text-decoration-underline" id="clearall">Clear All</a>
                        </div>
                    </div>

                    <div class="search-product">
                        <input class="form-control" type="text" id="search-product" placeholder="Search product..." />
                    </div>
                </div>

                <div class="accordion accordion-flush filter-accordion">

                    <div class="card-body border-bottom">
                        <div>
                            <p class="text-muted text-uppercase fs-12 fw-medium mb-2">Products</p>
                            <div class="search-box search-box-sm mb-2">
                                <input type="text" class="form-control bg-light border-0" id="searchProductTypeList"
                                    placeholder="Search Products...">
                                <i class="ri-search-line search-icon"></i>
                            </div>
                            <div class="overflow-auto" style="max-height: 220px;">
                                <ul class="list-unstyled mb-0 filter-list" id="typeof-product-list">
                                    <li class="text-muted">Loading...</li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="card-body border-bottom">
                        <p class="text-muted text-uppercase fs-12 fw-medium mb-4">Price</p>
                        <div class="slider" id="slider-merging-tooltips"></div>
                        <div class="formCost d-flex gap-2 align-items-center mt-3">
                            <input class="form-control form-control-sm" type="number" id="minCost" value="0" />
                            <span class="fw-semibold text-muted">to</span>
                            <input class="form-control form-control-sm" type="number" id="maxCost" value="50000" />
                        </div>
                    </div>

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingBrands">
                            <button class="accordion-button bg-transparent shadow-none" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseBrands" aria-expanded="true"
                                aria-controls="flush-collapseBrands">
                                <span class="text-muted text-uppercase fs-12 fw-medium">Brands</span> <span
                                    class="badge bg-success rounded-pill align-middle ms-1 filter-badge"
                                    id="checked_brands_count"></span>
                            </button>
                        </h2>

                        <div id="flush-collapseBrands" class="accordion-collapse collapse show"
                            aria-labelledby="flush-headingBrands">
                            <div class="accordion-body text-body pt-0">
                                <div class="search-box search-box-sm">
                                    <input type="text" class="form-control bg-light border-0" id="searchBrandsList"
                                        placeholder="Search Brands...">
                                    <i class="ri-search-line search-icon"></i>
                                </div>
                                <div class="overflow-auto" style="max-height: 220px;">
                                    <div class="d-flex flex-column gap-2 mt-3 filter-check" id="brand-list">
                                        <div class="text-muted">Loading...</div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end accordion-item -->

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingDiscount">
                            <button class="accordion-button bg-transparent shadow-none collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseDiscount" aria-expanded="true"
                                aria-controls="flush-collapseDiscount">
                                <span class="text-muted text-uppercase fs-12 fw-medium">Discount</span> <span
                                    class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                            </button>
                        </h2>
                        <div id="flush-collapseDiscount" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingDiscount">
                            <div class="accordion-body text-body pt-1">
                                <div class="d-flex flex-column gap-2 filter-check">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="50% or more"
                                            id="productdiscountRadio6">
                                        <label class="form-check-label" for="productdiscountRadio6">50% or more</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="40% or more"
                                            id="productdiscountRadio5">
                                        <label class="form-check-label" for="productdiscountRadio5">40% or more</label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="30% or more"
                                            id="productdiscountRadio4">
                                        <label class="form-check-label" for="productdiscountRadio4">
                                            30% or more
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="20% or more"
                                            id="productdiscountRadio3" checked>
                                        <label class="form-check-label" for="productdiscountRadio3">
                                            20% or more
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="10% or more"
                                            id="productdiscountRadio2">
                                        <label class="form-check-label" for="productdiscountRadio2">
                                            10% or more
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="Less than 10%"
                                            id="productdiscountRadio1">
                                        <label class="form-check-label" for="productdiscountRadio1">
                                            Less than 10%
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end accordion-item -->

                    <div class="accordion-item">
                        <h2 class="accordion-header" id="flush-headingRating">
                            <button class="accordion-button bg-transparent shadow-none collapsed" type="button"
                                data-bs-toggle="collapse" data-bs-target="#flush-collapseRating" aria-expanded="false"
                                aria-controls="flush-collapseRating">
                                <span class="text-muted text-uppercase fs-12 fw-medium">Rating</span> <span
                                    class="badge bg-success rounded-pill align-middle ms-1 filter-badge"></span>
                            </button>
                        </h2>

                        <div id="flush-collapseRating" class="accordion-collapse collapse"
                            aria-labelledby="flush-headingRating">
                            <div class="accordion-body text-body">
                                <div class="d-flex flex-column gap-2 filter-check">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="4 & Above Star"
                                            id="productratingRadio4" checked>
                                        <label class="form-check-label" for="productratingRadio4">
                                            <span class="text-muted">
                                                <i class="mdi mdi-star text-warning"></i>
                                                <i class="mdi mdi-star text-warning"></i>
                                                <i class="mdi mdi-star text-warning"></i>
                                                <i class="mdi mdi-star text-warning"></i>
                                                <i class="mdi mdi-star"></i>
                                            </span> 4 & Above
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="3 & Above Star"
                                            id="productratingRadio3">
                                        <label class="form-check-label" for="productratingRadio3">
                                            <span class="text-muted">
                                                <i class="mdi mdi-star text-warning"></i>
                                                <i class="mdi mdi-star text-warning"></i>
                                                <i class="mdi mdi-star text-warning"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                            </span> 3 & Above
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="2 & Above Star"
                                            id="productratingRadio2">
                                        <label class="form-check-label" for="productratingRadio2">
                                            <span class="text-muted">
                                                <i class="mdi mdi-star text-warning"></i>
                                                <i class="mdi mdi-star text-warning"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                            </span> 2 & Above
                                        </label>
                                    </div>
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" value="1 Star"
                                            id="productratingRadio1">
                                        <label class="form-check-label" for="productratingRadio1">
                                            <span class="text-muted">
                                                <i class="mdi mdi-star text-warning"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                                <i class="mdi mdi-star"></i>
                                            </span> 1
                                        </label>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end accordion-item -->
                </div>
            </div>
            <!-- end card -->
        </div>
        <!-- end col -->

        <div class="col-xl-9 col-lg-8">
            <div>
                <div class="card">
                    <div class="card-header border-0">
                        <div class="row g-4">
                            <div class="col-sm-auto">
                                <div>
                                    <a href="{{ route('create-product') }}" class="btn btn-info" id="addproduct-btn"><i
                                            class="ri-add-line align-bottom me-1"></i> Add Product</a>
                                </div>
                            </div>
                            {{-- <div class="col-sm">
                                <div class="d-flex justify-content-sm-end">
                                    <div class="search-box ms-2">
                                        <input type="text" class="form-control" id="searchProductList"
                                            placeholder="Search Products...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                            </div> --}}
                        </div>
                    </div>

                    <div class="card-header">
                        <div class="row align-items-center">
                            <div class="col">
                                <ul class="nav nav-tabs-custom card-header-tabs border-bottom-0" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active fw-semibold" data-bs-toggle="tab"
                                            href="#productnav-all" role="tab">
                                            All <span
                                                class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">{{ $count['all_product'] }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-schedule"
                                            role="tab">
                                            Schedule <span
                                                class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">{{ $count['schedule'] }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-published"
                                            role="tab">
                                            Published <span
                                                class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">{{ $count['published'] }}</span>
                                        </a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link fw-semibold" data-bs-toggle="tab" href="#productnav-draft"
                                            role="tab">
                                            Draft<span
                                                class="badge bg-danger-subtle text-danger align-middle rounded-pill ms-1">{{ $count['draft'] }}</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="col-auto">
                                <div id="selection-element">
                                    <div class="my-n1 d-flex align-items-center text-muted">
                                        Select <div id="select-content" class="text-body fw-semibold px-1"></div> Result
                                        <button type="button"
                                            class="btn btn-link link-danger p-0 ms-3 material-shadow-none"
                                            data-bs-toggle="modal" data-bs-target="#removeItemModal">Remove</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- end card header -->
                    <div class="card-body">

                        <div class="tab-content text-muted">
                            <div class="tab-pane active" id="productnav-all" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="all-datatables" class="display table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>Product</th>
                                                <th>Status</th>
                                                <th>Stock</th>
                                                <th>Price</th>
                                                <th>Order</th>
                                                <th>Rating</th>
                                                <th>Published</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane" id="productnav-schedule" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="schedule-datatables" class="display table table-bordered"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>Product</th>
                                                <th>Status</th>
                                                <th>Stock</th>
                                                <th>Price</th>
                                                <th>Order</th>
                                                <th>Rating</th>
                                                <th>Published</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane" id="productnav-published" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="publish-datatables" class="display table table-bordered"
                                        style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>Product</th>
                                                <th>Status</th>
                                                <th>Stock</th>
                                                <th>Price</th>
                                                <th>Order</th>
                                                <th>Rating</th>
                                                <th>Published</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- end tab pane -->

                            <div class="tab-pane" id="productnav-draft" role="tabpanel">
                                <div class="table-responsive">
                                    <table id="draft-datatables" class="display table table-bordered" style="width:100%">
                                        <thead>
                                            <tr>
                                                <th>S.no</th>
                                                <th>Product</th>
                                                <th>Status</th>
                                                <th>Stock</th>
                                                <th>Price</th>
                                                <th>Order</th>
                                                <th>Rating</th>
                                                <th>Published</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                    </table>
                                </div>
                            </div>
                            <!-- end tab pane -->
                        </div>
                        <!-- end tab content -->

                    </div>
                    <!-- end card body -->
                </div>
                <!-- end card -->
            </div>
        </div>
        <!-- end col -->
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {

            let minRange = 0;
            let maxRange = 50000;
            let slider = document.getElementById('slider-merging-tooltips');

            noUiSlider.create(slider, {
                start: [0, 50000],
                connect: true,
                range: {
                    min: minRange,
                    max: maxRange
                },
                tooltips: true,
                format: {
                    to: value => Math.round(value),
                    from: value => Number(value)
                }
            });

            slider.noUiSlider.on('update', function(values) {
                $('#minCost').val(values[0]);
                $('#maxCost').val(values[1]);
            });

            $('#minCost, #maxCost').on('keyup change', function() {
                let minVal = $('#minCost').val();
                let maxVal = $('#maxCost').val();
                if (minVal === '' || maxVal === '') return;
                let min = Number(minVal);
                let max = Number(maxVal);
                if (min < minRange || max > maxRange) return;
                if (min > max) return;
                slider.noUiSlider.set([min, max]);
            });

        });
    </script>
    <script>
        $(document).ready(function() {
            function loadProductTypes(search = '') {
                $.ajax({
                    url: "{{ route('typeof-product-list') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product: search
                    },
                    success: function(response) {
                        let product_type = $('#typeof-product-list');
                        let html = '';
                        product_type.empty();
                        if (response.status === 'success' && response.data.length > 0) {
                            $.each(response.data, function(key, value) {
                                html += `
                                    <li>
                                        <a href="#"
                                        class="product_type_item d-flex py-1 align-items-center"
                                        data-id="${value.id}">
                                            <div class="flex-grow-1">
                                                <h5 class="fs-13 mb-0 listname">
                                                    ${value.child_category}
                                                </h5>
                                            </div>
                                            <div class="flex-shrink-0 me-2">
                                                ${value.child_category_count > 0
                                                    ? `<span class="badge bg-light text-muted">${value.child_category_count}</span>`
                                                    : ``}
                                            </div>
                                        </a>
                                    </li>
                                    `;
                            });
                        } else {
                            html = '<li class="text-muted">No products found</li>';
                        }

                        product_type.html(html);
                    },
                    error: function(xhr) {
                        console.error(xhr.responseText);
                    }
                });
            }
            loadProductTypes();
            $('#searchProductTypeList').on('keyup', function() {
                loadProductTypes($(this).val());
            });

            function brands(search = '') {
                $.ajax({
                    url: "{{ route('typeof-brands-list') }}",
                    method: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        brands: search
                    },
                    success: function(response) {
                        let brands = $('#brand-list');
                        let html = ``;
                        brands.empty();
                        if (response.status === 'success' && response.data.length > 0) {
                            $.each(response.data, function(key, value) {
                                html += `
                                    <div class="form-check">
                                        <input class="form-check-input brand-checkbox" type="checkbox" value="${value.id}"
                                            id="brand_${value.id}">
                                        <label class="form-check-label" for="brand_${value.id}">${value.brands}</label>
                                    </div>
                                    `;
                            });
                            brands.html(html);
                        }
                    },
                    error: function(xhr) {
                        console.log('Error:', xhr.responseText);
                        alert('Something went wrong');
                    }
                });
            }
            brands();
            $('#searchBrandsList').on('keyup', function() {
                brands($(this).val());
            });

            function updateCheckedBrandsCount() {
                let count = $('.brand-checkbox:checked').length;
                $('#checked_brands_count').text(count > 0 ? count : '');
            }
            $(document).on('change', '.brand-checkbox', function() {
                updateCheckedBrandsCount();
            });
        });
    </script>
    <script>
        $(document).ready(function() {

            let searchProduct = '';
            let selectedProductType = '';
            let minCost = 0;
            let maxCost = 30000;

            // ✅ slider define karo
            let slider = document.getElementById('slider-merging-tooltips');

            function getSelectedBrands() {
                let brands = [];
                $('.brand-checkbox:checked').each(function() {
                    brands.push($(this).val());
                });
                return brands;
            }

            function allProductShow(serach = '', product = '', from_price = '', to_price = '', brands = []) {
                $.ajax({
                    url: "{{ route('show-all-products') }}",
                    method: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_name: serach,
                        product_id: product,
                        from_price: from_price,
                        to_price: to_price,
                        brands: brands
                    },
                    success: function(response) {

                        if ($.fn.DataTable.isDataTable('#all-datatables')) {
                            $('#all-datatables').DataTable().clear().destroy();
                        }

                        $('#all-datatables').DataTable({
                            data: response.data,
                            dom: "Bfrtip",
                            buttons: ["copy", "csv", "excel", "print", "pdf"],
                            processing: true,
                            paging: true,
                            searching: true,
                            ordering: true,
                            responsive: true,
                            columnDefs: [{
                                targets: [0],
                                orderable: false
                            }],
                            columns: [{
                                    data: 'sn'
                                },
                                {
                                    data: 'product_name'
                                },
                                {
                                    data: 'status'
                                },
                                {
                                    data: 'stock'
                                },
                                {
                                    data: 'price'
                                },
                                {
                                    data: 'order'
                                },
                                {
                                    data: 'rating'
                                },
                                {
                                    data: 'published'
                                },
                                {
                                    data: 'action'
                                }
                            ]
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert("Something went wrong");
                    }
                });
            }

            function scheduleProductShow(serach = '', product = '', from_price = '', to_price = '', brands = []) {
                $.ajax({
                    url: "{{ route('show-schedule-products') }}",
                    method: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_name: serach,
                        product_id: product,
                        from_price: from_price,
                        to_price: to_price,
                        brands: brands
                    },
                    success: function(response) {

                        if ($.fn.DataTable.isDataTable('#schedule-datatables')) {
                            $('#schedule-datatables').DataTable().clear().destroy();
                        }

                        $('#schedule-datatables').DataTable({
                            data: response.data,
                            dom: "Bfrtip",
                            buttons: ["copy", "csv", "excel", "print", "pdf"],
                            processing: true,
                            paging: true,
                            searching: true,
                            ordering: true,
                            responsive: true,
                            columnDefs: [{
                                targets: [0],
                                orderable: false
                            }],
                            columns: [{
                                    data: 'sn'
                                },
                                {
                                    data: 'product_name'
                                },
                                {
                                    data: 'status'
                                },
                                {
                                    data: 'stock'
                                },
                                {
                                    data: 'price'
                                },
                                {
                                    data: 'order'
                                },
                                {
                                    data: 'rating'
                                },
                                {
                                    data: 'published'
                                },
                                {
                                    data: 'action'
                                }
                            ]
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert("Something went wrong");
                    }
                });
            }

            function publishProductShow(serach = '', product = '', from_price = '', to_price = '', brands = []) {
                $.ajax({
                    url: "{{ route('show-publish-products') }}",
                    method: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_name: serach,
                        product_id: product,
                        from_price: from_price,
                        to_price: to_price,
                        brands: brands
                    },
                    success: function(response) {

                        if ($.fn.DataTable.isDataTable('#publish-datatables')) {
                            $('#publish-datatables').DataTable().clear().destroy();
                        }

                        $('#publish-datatables').DataTable({
                            data: response.data,
                            dom: "Bfrtip",
                            buttons: ["copy", "csv", "excel", "print", "pdf"],
                            processing: true,
                            paging: true,
                            searching: true,
                            ordering: true,
                            responsive: true,
                            columnDefs: [{
                                targets: [0],
                                orderable: false
                            }],
                            columns: [{
                                    data: 'sn'
                                },
                                {
                                    data: 'product_name'
                                },
                                {
                                    data: 'status'
                                },
                                {
                                    data: 'stock'
                                },
                                {
                                    data: 'price'
                                },
                                {
                                    data: 'order'
                                },
                                {
                                    data: 'rating'
                                },
                                {
                                    data: 'published'
                                },
                                {
                                    data: 'action'
                                }
                            ]
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert("Something went wrong");
                    }
                });
            }

            function draftProductShow(serach = '', product = '', from_price = '', to_price = '', brands = []) {
                $.ajax({
                    url: "{{ route('show-draft-products') }}",
                    method: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_name: serach,
                        product_id: product,
                        from_price: from_price,
                        to_price: to_price,
                        brands: brands
                    },
                    success: function(response) {

                        if ($.fn.DataTable.isDataTable('#draft-datatables')) {
                            $('#draft-datatables').DataTable().clear().destroy();
                        }

                        $('#draft-datatables').DataTable({
                            data: response.data,
                            dom: "Bfrtip",
                            buttons: ["copy", "csv", "excel", "print", "pdf"],
                            processing: true,
                            paging: true,
                            searching: true,
                            ordering: true,
                            responsive: true,
                            columnDefs: [{
                                targets: [0],
                                orderable: false
                            }],
                            columns: [{
                                    data: 'sn'
                                },
                                {
                                    data: 'product_name'
                                },
                                {
                                    data: 'status'
                                },
                                {
                                    data: 'stock'
                                },
                                {
                                    data: 'price'
                                },
                                {
                                    data: 'order'
                                },
                                {
                                    data: 'rating'
                                },
                                {
                                    data: 'published'
                                },
                                {
                                    data: 'action'
                                }
                            ]
                        });
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert("Something went wrong");
                    }
                });
            }

            allProductShow('', '', minCost, maxCost, getSelectedBrands());
            scheduleProductShow('', '', minCost, maxCost, getSelectedBrands());
            publishProductShow('', '', minCost, maxCost, getSelectedBrands());
            draftProductShow('', '', minCost, maxCost, getSelectedBrands());
            $(document).on('keyup', '#search-product', function(e) {
                e.preventDefault();
                searchProduct = $(this).val();
                allProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost').val(),
                    getSelectedBrands());
                scheduleProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost')
                    .val(),
                    getSelectedBrands());
                publishProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost')
                    .val(),
                    getSelectedBrands());
                draftProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost')
                    .val(),
                    getSelectedBrands());
            });
            $(document).on('click', '.product_type_item', function(e) {
                e.preventDefault();
                selectedProductType = $(this).data('id');
                allProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost').val(),
                    getSelectedBrands());
                scheduleProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost')
                    .val(),
                    getSelectedBrands());
                publishProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost')
                    .val(),
                    getSelectedBrands());
                draftProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost')
                    .val(),
                    getSelectedBrands());
                $('.product_type_item').removeClass('active');
                $(this).addClass('active');
            });

            $(document).on('change', '.brand-checkbox', function() {
                allProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost').val(),
                    getSelectedBrands());
                scheduleProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost')
                    .val(),
                    getSelectedBrands());
                publishProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost')
                    .val(),
                    getSelectedBrands());
                draftProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost')
                    .val(),
                    getSelectedBrands());
            });

            slider.noUiSlider.on('update', function() {
                allProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost').val(),
                    getSelectedBrands());
                scheduleProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost')
                    .val(),
                    getSelectedBrands());
                publishProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost')
                    .val(),
                    getSelectedBrands());
                draftProductShow(searchProduct, selectedProductType, $('#minCost').val(), $('#maxCost')
                    .val(),
                    getSelectedBrands());
            });
        });
    </script>

@endsection
