@extends('backend.layout.main')
@section('title', 'Child-Category')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Child-Category</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ri-home-8-line"></i>
                                Dashboard</a>
                        </li>
                        <li class="breadcrumb-item active">Child-Category</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @include('backend.alert.simple-alert')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header d-flex justify-content-between align-items-center flex-wrap">
                    <!-- Left Side -->
                    <h5 class="card-title mb-0">Child-Category</h5>

                    <!-- Right Side -->
                    <div class="d-flex gap-2">
                        <button class="btn btn-info btn-label right create-category-btn" data-bs-toggle="modal"
                            data-bs-target=".bs-example-modal-center">
                            <i class="ri-edit-2-fill label-icon align-middle fs-16 ms-2"></i>
                            Create
                        </button>
                        <a class="btn btn-warning btn-label right" href="{{ route('childcategory-bulkupload') }}">
                            <i class="ri-chat-upload-line label-icon align-middle fs-16 ms-2"></i>
                            Bulk Upload
                        </a>
                        <div class="dropdown">
                            <button type="button" class="btn btn-primary btn-label right dropdown-toggle"
                                data-bs-toggle="dropdown">
                                <i class="ri-user-smile-line label-icon align-middle fs-16 ms-2"></i>
                                Download
                            </button>
                            <ul class="dropdown-menu dropdown-menu-end">
                                <li>
                                    <a class="dropdown-item" href="{{ route('child-category-excel') }}">
                                        <i class="ri-file-excel-2-line me-2"></i> Download Excel
                                    </a>
                                </li>
                                <li>
                                    <a class="dropdown-item" href="{{ route('child-category-pdf') }}">
                                        <i class="ri-file-pdf-line me-2"></i> Download PDF
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>

                <div class="card-body">
                    <div class="table-responsive">
                        <table id="buttons-datatables" class="display table table-bordered" style="width:100%">
                            <thead>
                                <tr>
                                    <th>S.no</th>
                                    <th>Child Category</th>
                                    <th>Slug</th>
                                    <th>Category</th>
                                    <th>Image</th>
                                    <th>Status</th>
                                    <th>Created At</th>
                                    <th>Updated At</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $i = 1;
                                @endphp
                                @foreach ($category_child as $values)
                                    <tr>
                                        <td>{{ $i++ }}</td>
                                        <td>{{ $values->child_category }}</td>
                                        <td>{{ $values->slug }}</td>
                                        <td>{{ $values->category->categories }}</td>
                                        <td>
                                            @php
                                                $img_path = !empty($values->img_path)
                                                    ? asset('backend/upload/image/child-category/' . $values->img_path)
                                                    : asset('backend/assets/images/default_image.jpg');
                                            @endphp
                                            <div class="avatar-xs justify-content-between bg-light rounded p-1 me-2">
                                                <img src="{{ $img_path }}" alt="Child Category"
                                                    class="img-fluid d-block">
                                            </div>
                                        </td>
                                        <td>
                                            @if ($values->status == 'active')
                                                <span class="badge bg-primary-subtle text-primary"><i
                                                        class="ri-checkbox-circle-line align-middle text-success"></i>Active</span>
                                            @elseif ($values->status == 'inactive')
                                                <span class="badge bg-warning-subtle text-warning"><i
                                                        class="ri-eye-off-line align-middle text-warning"></i>In-active</span>
                                            @else
                                                <span class="badge bg-danger-subtle text-danger"><i
                                                        class="ri-close-circle-line align-middle text-danger"></i>Suspended</span>
                                            @endif
                                        </td>
                                        <td>{{ $values->created_at }}</td>
                                        <td>{{ $values->updated_at }}</td>
                                        <td>
                                            <div class="hstack gap-3 flex-wrap">
                                                <a href="javascript:void(0);"
                                                    class="link-success fs-15 update-child-category"
                                                    data-id="{{ $values->id }}" data-bs-toggle="modal"
                                                    data-bs-target=".bs-example-modal-center"><i
                                                        class="ri-edit-2-line"></i></a>
                                                <a href="{{ route('delete-child-category', ['id' => $values->id]) }}"
                                                    class="link-danger fs-15"><i class="ri-delete-bin-line"></i></a>
                                            </div>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- create modal --}}
    <div class="modal fade bs-example-modal-center" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel"
        aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="varyingcontentModalLabel">
                        Create Child Categories
                    </h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="{{ route('create-child-category') }}" method="POST" autocomplete="off"
                        enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <input type="hidden" id="cat_id" name="id">
                                    <label for="customer-name" class="col-form-label">Child Category:</label>
                                    <input type="text" class="form-control" id="child_category" name="child_category" />
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="customer-name" class="col-form-label">Slug:</label>
                                    <input type="text" class="form-control" id="slug" name="slug" readonly />
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="customer-name" class="col-form-label">Category:</label>
                                    <select name="category_id" id="category_id" class="form-select" data-choices
                                        data-choices-sorting="true">
                                        <option selected>Choose...</option>
                                        @foreach ($category as $values)
                                            <option value="{{ $values->id }}">{{ $values->categories }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label for="customer-name" class="col-form-label">Status:</label>
                                    <select name="status" class="form-select status" data-choices
                                        data-choices-sorting="true">
                                        <option selected>Choose...</option>
                                        <option value="active">Active</option>
                                        <option value="inactive">In-Active</option>
                                        <option value="suspended">Suspended</option>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="customer-name" class="col-form-label">Image Upload:</label>
                            <input type="file" class="form-control" id="img_path" name="img_path" />
                            <span class="d-inline-block text-truncate text-danger" id="image_source"></span>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-info" data-bs-dismiss="modal">
                                Back
                            </button>
                            <button type="submit" class="btn btn-primary">
                                Submit
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).on('click', '.create-category-btn', function() {
            $('#cat_id').val('');
            $('#categories').val('');
            $('#slug').val('');
            $('.status').val('');
            $('#varyingcontentModalLabel').text('Create Categories');
        });
        $(document).on('input', '#child_category', function() {
            let category = $(this).val();
            let ucfirst = category.toLowerCase().replace(/\b\w/g, function(char) {
                return char.toUpperCase();
            });
            let slug = ucfirst.toLowerCase().trim().replace(/\s+/g, '-').replace(/[^\w\-]+/g, '');
            $('#child_category').val(ucfirst);
            $('#slug').val(slug);
        });
        $(document).on('click', '.update-child-category', function() {
            let id = $(this).data('id');

            $.ajax({
                url: "{{ route('get-child-category', ':id') }}".replace(':id', id),
                type: "GET",
                dataType: "json",
                success: function(response) {
                    if (response.status === 'success') {
                        $('#cat_id').val(response.data.id);
                        $('#child_category').val(response.data.child_category);
                        $('#slug').val(response.data.slug);
                        $('#category_id').val(response.data.category_id);
                        $('.status').val(response.data.status);
                        $('#image_source').text(response.data.img_path);
                    }
                },
                error: function() {
                    alert("Something went wrong!");
                }
            });
        });
    </script>
@endsection
