@extends('backend.layout.main')
@section('title', 'Update Product Image')
@section('content')
    <style>
        .dropzone-box {
            border: 2px dashed #ced4da;
            border-radius: 8px;
            padding: 40px;
            cursor: pointer;
            background: #fafafa;
            transition: 0.3s;
        }

        .dropzone-box:hover {
            background: #f1f1f1;
        }

        .dropzone-box.dragover {
            border-color: #0d6efd;
            background: #e9f2ff;
        }
    </style>

    <div class="row">
        <div class="col-12">
            <div class="page-title-box d-sm-flex align-items-center justify-content-between bg-galaxy-transparent">
                <h4 class="mb-sm-0">Update Product Image</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ri-home-8-line"></i>
                                Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('product') }}">Product</a></li>
                        <li class="breadcrumb-item active">Update Product Image</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    @include('backend.alert.simple-alert')
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title mb-0">Create Product Image</h4>
                </div>
                <div class="card-body">
                    <p class="text-muted">DropzoneJS is an open source library that provides drag’n’drop file uploads
                        with image previews.</p>
                    <form action="{{ route('product-image-update') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="product_id">Product</label>
                                    <select class="js-example-basic-single @error('product_id') is-invalid @enderror"
                                        id="product_id" name="product_id">
                                        <option value="" selected>Product</option>
                                    </select>
                                    @error('product_id')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6 col-12">
                                <div class="mb-3">
                                    <label class="form-label" for="product_status">Status</label>
                                    <select
                                        class="form-control js-example-basic-single @error('product_status') is-invalid @enderror"
                                        name="product_status">
                                        <option value="active"
                                            {{ old('product_status', $productImage->product_status) === 'active' ? 'selected' : '' }}>
                                            Active
                                        </option>
                                        <option value="inactive"
                                            {{ old('product_status', $productImage->product_status) === 'inactive' ? 'selected' : '' }}>
                                            In-active
                                        </option>
                                        <option value="suspended"
                                            {{ old('product_status', $productImage->product_status) === 'suspended' ? 'selected' : '' }}>
                                            Suspended
                                        </option>
                                    </select>
                                    @error('product_status')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="dropzone-box" id="dropzoneBox">
                            <input type="file" name="image_path[]" id="imageInput" multiple
                                accept=".jpg,.jpeg,.png,.webp" hidden>
                            <div class="dz-message text-center">
                                <i class="ri-upload-cloud-2-fill fs-1 text-muted"></i>
                                <h5 class="mt-2">Drop files here or click to upload</h5>
                                <p class="text-muted">Only image files allowed</p>
                            </div>
                        </div>
                        <div class="text-end mt-3">
                            <div class="d-flex gap-2">
                                <button type="button" class="btn btn-info ms-3" data-bs-dismiss="modal">
                                    Back
                                </button>
                                <button type="submit" class="btn btn-primary">
                                    Submit
                                </button>
                            </div>
                        </div>
                        <div class="row mt-3" id="previewContainer"></div>
                    </form>
                    @if ($images->count())
                        <hr>
                        <h5>Already Uploaded Images</h5>

                        <div class="row">
                            @foreach ($images as $img)
                                <div class="col-md-3 mb-3">
                                    <div class="card">
                                        <img src="{{ asset('backend/upload/image/product/' . $product->product_slug . '/' . $img->image_path) }}"
                                            style="height:200px;object-fit:cover">

                                        <div class="card-body p-2">
                                            <form action="{{ route('product-image-delete', encrypt($img->id)) }}"
                                                method="POST" onsubmit="return confirm('You want to delete this image?')">
                                                @csrf
                                                @method('DELETE')
                                                <button class="btn btn-danger btn-sm w-100">
                                                    Remove
                                                </button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        /* PRODUCT DROPDOWN */
        $(document).ready(function() {
            let selected = "{{ $productImage->product_id }}";
            $.get("{{ route('get-product') }}", function(res) {
                $.each(res.data, function(i, v) {
                    $('#product_id').append(
                        `<option value="${v.id}" ${v.id==selected?'selected':''}>${v.product_title}</option>`
                    );
                });
            });
        });

        /* DROPZONE PREVIEW */
        let files = [];
        const input = document.getElementById('imageInput');
        const dropzone = document.getElementById('dropzoneBox');
        const preview = document.getElementById('previewContainer');

        dropzone.onclick = () => input.click();

        input.onchange = e => {
            files = [...files, ...e.target.files];
            render();
        };

        function render() {
            preview.innerHTML = '';
            const dt = new DataTransfer();

            files.forEach((file, i) => {
                dt.items.add(file);
                const reader = new FileReader();
                reader.onload = e => {
                    preview.innerHTML += `
                    <div class="col-md-3 mb-3">
                         <div class="card">
                            <img src="${e.target.result}" class="card-img-top" style="height:250px;object-fit:cover">
                            <div class="card-body p-2">
                                <button type="button"
                                    class="btn btn-danger btn-sm w-100"
                                    onclick="remove(${i})">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>`;
                };
                reader.readAsDataURL(file);
            });

            input.files = dt.files;
        }

        function remove(i) {
            files.splice(i, 1);
            render();
        }
    </script>
@endsection
