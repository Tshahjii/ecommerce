@extends('backend.layout.main')
@section('title', 'Create Product Image')
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
                <h4 class="mb-sm-0">Create Product Image</h4>
                <div class="page-title-right">
                    <ol class="breadcrumb m-0">
                        <li class="breadcrumb-item"><a href="{{ route('dashboard') }}"><i class="ri-home-8-line"></i>
                                Dashboard</a>
                        </li>
                        <li class="breadcrumb-item"><a href="{{ route('product') }}">Product</a></li>
                        <li class="breadcrumb-item active">Create Product Image</li>
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
                    <form action="{{ route('product-image-add') }}" method="POST" enctype="multipart/form-data">
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
                                    <select class="js-example-basic-single @error('product_status') is-invalid @enderror"
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
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            let product = $('#product_id');
            product.empty();
            product.append('<option value="" selected>Product</option>');
            $.ajax({
                url: "{{ route('get-product') }}",
                method: "GET",
                dataType: "json",
                success: function(response) {
                    $.each(response.data, function(key, value) {
                        product.append('<option value="' + value.id + '">' + value
                            .product_title + '</option>');
                    });
                },
                error: function(xhr) {
                    console.log('Error:', xhr.responseText);
                    alert('Something went wrong');
                }
            });
        });
        let selectedFiles = [];
        const dropzone = document.getElementById('dropzoneBox');
        const input = document.getElementById('imageInput');
        const preview = document.getElementById('previewContainer');

        dropzone.addEventListener('click', () => input.click());

        input.addEventListener('change', e => {
            selectedFiles = selectedFiles.concat(Array.from(e.target.files));
            renderPreview();
        });

        dropzone.addEventListener('dragover', e => {
            e.preventDefault();
            dropzone.classList.add('dragover');
        });

        dropzone.addEventListener('dragleave', () => dropzone.classList.remove('dragover'));

        dropzone.addEventListener('drop', e => {
            e.preventDefault();
            dropzone.classList.remove('dragover');
            selectedFiles = selectedFiles.concat(Array.from(e.dataTransfer.files));
            renderPreview();
        });

        function renderPreview() {
            preview.innerHTML = '';

            selectedFiles.forEach((file, index) => {
                const reader = new FileReader();

                reader.onload = e => {
                    preview.innerHTML += `
                    <div class="col-md-3 mb-3">
                        <div class="card">
                            <img src="${e.target.result}" class="card-img-top" style="height:250px;object-fit:cover">
                            <div class="card-body p-2">
                                <p class="small mb-1 text-truncate">${file.name}</p>
                                <button type="button"
                                    class="btn btn-sm btn-danger w-100"
                                    onclick="removeImage(${index})">
                                    Remove
                                </button>
                            </div>
                        </div>
                    </div>
                `;
                };
                reader.readAsDataURL(file);
            });
            updateInputFiles();
        }

        function removeImage(index) {
            selectedFiles.splice(index, 1);
            renderPreview();
        }

        function updateInputFiles() {
            const dataTransfer = new DataTransfer();
            selectedFiles.forEach(file => dataTransfer.items.add(file));
            input.files = dataTransfer.files;
        }
    </script>
@endsection
