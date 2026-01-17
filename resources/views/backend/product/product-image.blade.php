@extends('backend.layout.main')
@section('title', 'Product Image')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Product Image</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ri-home-8-line"></i>
                                Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Product Image</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @include('backend.alert.simple-alert')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-header border-bottom-dashed">
                        <div class="row g-1 align-items-center">
                            <div class="col-sm">
                                <div>
                                    <h5 class="card-title mb-0">Products Image</h5>
                                </div>
                            </div>
                            <div class="col-sm-auto">
                                <div class="d-flex flex-wrap align-items-start gap-2">
                                    <a href="{{ route('create-product-image') }}" class="btn btn-success add-btn"><i
                                            class="ri-add-line align-bottom me-1"></i>Create Products Image</a>
                                    <button type="button" class="btn btn-info"><i
                                            class="ri-file-download-line align-bottom me-1"></i> Import</button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-body border-bottom-dashed border-bottom">
                        <form>
                            <div class="row g-3">
                                <div class="col-xl-6">
                                    <div class="search-box">
                                        <input type="text" class="form-control search" id="product_name"
                                            placeholder="Search for product, status or something...">
                                        <i class="ri-search-line search-icon"></i>
                                    </div>
                                </div>
                                <!--end col-->
                                <div class="col-xl-6">
                                    <div class="row g-3">
                                        <div class="col-sm-4">
                                            <div class="">
                                                <input type="date" class="form-control" id="datepicker-range"
                                                    data-provider="flatpickr" data-date-format="d M, Y"
                                                    data-range-date="true" placeholder="Select date">
                                            </div>
                                        </div>
                                        <!--end col-->
                                        <div class="col-sm-4">
                                            <div>
                                                <select class="form-control" data-plugin="choices" data-choices
                                                    data-choices-search-false name="choices-single-default" id="idStatus">
                                                    <option value="" selected>Status</option>
                                                    <option value="active">Active</option>
                                                    <option value="inactive">In-active</option>
                                                    <option value="suspended">Suspended</option>
                                                </select>
                                            </div>
                                        </div>
                                        <!--end col-->
                                    </div>
                                </div>
                            </div>
                            <!--end row-->
                        </form>
                    </div>
                    <div class="table-responsive mt-2">
                        <table id="productImage-Table" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>
                                        <div class="form-check">
                                            <input class="form-check-input" type="checkbox" id="checkAll" value="option">
                                            S.no.
                                        </div>
                                    </th>
                                    <th>Product Name</th>
                                    <th>Images</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            let product_data = '';

            function allProductShow(search = '', date = '', status = '') {
                $.ajax({
                    url: "{{ route('show-products-image') }}",
                    method: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        product_name: search,
                        dateTime: date,
                        status: status,
                    },
                    success: function(response) {

                        if ($.fn.DataTable.isDataTable('#productImage-Table')) {
                            $('#productImage-Table').DataTable().clear().destroy();
                        }

                        $('#productImage-Table').DataTable({
                            data: response.data,
                            dom: "Bfrtip",
                            buttons: ["copy", "csv", "excel", "print", "pdf"],
                            processing: true,
                            paging: true,
                            searching: true,
                            ordering: true,
                            responsive: true,
                            autoWidth: false,
                            serverSide: false,

                            columnDefs: [{
                                targets: [0, 2, 4],
                                orderable: false
                            }],

                            columns: [{
                                    data: 'sn'
                                },
                                {
                                    data: 'product_name'
                                },
                                {
                                    data: 'images'
                                },
                                {
                                    data: 'status'
                                },
                                {
                                    data: 'created_at'
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

            // Initial load
            allProductShow('', '', '');

            // Search by product name
            $('#product_name').on('keyup', function() {
                product_data = $(this).val();
                allProductShow(product_data, $('#datepicker-range').val(), $('#idStatus').val());
            });

            // Filter by date
            $('#datepicker-range').on('change', function() {
                allProductShow(product_data, $(this).val(), $('#idStatus').val());
            });

            // Filter by status
            $('#idStatus').on('change', function() {
                allProductShow(product_data, $('#datepicker-range').val(), $(this).val());
            });

        });
    </script>
@endsection
