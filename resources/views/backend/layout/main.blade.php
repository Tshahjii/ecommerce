<!doctype html>
<html lang="en" data-layout="vertical" data-topbar="light" data-sidebar="dark" data-sidebar-size="lg"
    data-sidebar-image="none" data-preloader="disable" data-theme="default" data-theme-colors="default">

<head>
    <meta charset="utf-8" />
    <title>@yield('title') | Shahshop</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta content="Premium Multipurpose Admin & Dashboard Template" name="description" />
    <meta content="Themesbrand" name="author" />
    <link rel="shortcut icon" href="{{ asset('backend/assets/images/favicon.ico') }}">
    <link href="{{ asset('backend/assets/libs/jsvectormap/jsvectormap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/libs/swiper/swiper-bundle.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/select2.min.css') }}" rel="stylesheet" />
    <link href="{{ asset('backend/assets/libs/dropzone/dropzone.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ asset('backend/assets/css/buttons.dataTables.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/dataTables.bootstrap5.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/css/responsive.bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/filepond/filepond.min.css') }}" type="text/css" />
    <link rel="stylesheet"
        href="{{ asset('backend/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/nouislider/nouislider.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/libs/gridjs/theme/mermaid.min.css') }}">
    <script src="{{ asset('backend/assets/js/layout.js') }}"></script>
    <link href="{{ asset('backend/assets/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/icons.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/app.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('backend/assets/css/custom.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.7.1/nouislider.min.js"></script>

</head>

<body>
    <div id="layout-wrapper">
        @include('backend.layout.header')
        @include('backend.layout.sidebar')
        <div class="vertical-overlay"></div>
        <div class="main-content">
            <div class="page-content">
                <div class="container-fluid">
                    @yield('content')
                </div>
            </div>
            @include('backend.layout.footer')
        </div>
        <button onclick="topFunction()" class="btn btn-danger btn-icon" id="back-to-top">
            <i class="ri-arrow-up-line"></i>
        </button>
        <div id="preloader">
            <div id="status">
                <div class="spinner-border text-primary avatar-sm" role="status">
                    <span class="visually-hidden">Loading...</span>
                </div>
            </div>
        </div>
        @include('backend.layout.customizer')
    </div>
    <script src="{{ asset('backend/assets/js/jquery-3.6.0.min.js') }}"
        integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>
    <script src="{{ asset('backend/assets/libs/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/simplebar/simplebar.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/node-waves/waves.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/feather-icons/feather.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/plugins/lord-icon-2.1.0.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/apexcharts/apexcharts.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/jsvectormap/maps/world-merc.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/dashboard-ecommerce.init.js') }}"></script>

    {{-- <script src="{{ asset('backend/assets/js/plugins.js') }}"></script> --}}
    <script type='text/javascript'
        src="{{ asset('backend/assets/libs/choices.js/public/assets/scripts/choices.min.js') }}"></script>
    <script type='text/javascript' src="{{ asset('backend/assets/libs/flatpickr/flatpickr.min.js') }}"></script>

    <script src="{{ asset('backend/assets/libs/prismjs/prism.js') }}"></script>
    <script src="{{ asset('backend/assets/js/lordicon.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/modal.init.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jquery.dataTables.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dataTables.bootstrap5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dataTables.responsive.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/dataTables.buttons.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/buttons.print.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/buttons.html5.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/vfs_fonts.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pdfmake.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/jszip.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="{{ asset('backend/assets/js/select2.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/select2.init.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/datatables.init.js') }}"></script>
    <script src="{{ asset('backend/assets/js/app.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/ckeditor/ckeditor5-build-classic/build/ckeditor.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/dropzone/dropzone-min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/ecommerce-product-create.init.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/filepond/filepond.min.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/filepond-plugin-image-preview/filepond-plugin-image-preview.min.js') }}">
    </script>
    <script
        src="{{ asset('backend/assets/libs/filepond-plugin-file-validate-size/filepond-plugin-file-validate-size.min.js') }}">
    </script>
    <script
        src="{{ asset('backend/assets/libs/filepond-plugin-image-exif-orientation/filepond-plugin-image-exif-orientation.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/libs/filepond-plugin-file-encode/filepond-plugin-file-encode.min.js') }}">
    </script>
    <script src="{{ asset('backend/assets/js/pages/form-file-upload.init.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/wnumb/wNumb.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/range-sliders.init.js') }}"></script>
    <script src="{{ asset('backend/assets/libs/gridjs/gridjs.umd.js') }}"></script>
    <script src="{{ asset('backend/assets/js/selection.umd.js') }}"></script>
    <script src="{{ asset('backend/assets/js/pages/ecommerce-product-list.init.js') }}"></script>
</body>

</html>
