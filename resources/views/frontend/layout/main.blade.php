<!DOCTYPE html>
<html lang="zxx">

<head>
    <meta charset="utf-8" />
    <meta name="author" content="pxdraft" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width,initial-scale=1,shrink-to-fit=no" />
    <meta name="keywords" content="ShopApp - eCommerce Bootstrap 5 Template" />
    <meta name="description" content="ShopApp - eCommerce Bootstrap 5 Template" />
    <title>@yield('title') | SHAHSHOP</title>
    <link rel="shortcut icon" href="https://www.pxdraft.com/wrap/shopapp/assets/img/favicon.ico" />
    @yield('css')
    <link href="{{ asset('frontend/assets/css/style.css') }}" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.css" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.1.0/css/all.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.1.0/css/sharp-solid.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.1.0/css/sharp-regular.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.1.0/css/sharp-light.css" />
    <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v7.1.0/css/duotone.css" />
    <style>
        .shahproduct-img {
            width: 100%;
            height: 250px;
            object-fit: cover;
        }

        @media (max-width: 768px) {
            .shahproduct-img {
                height: 180px;
            }
        }

        @media (max-width: 480px) {
            .shahproduct-img {
                height: 150px;
            }
        }

        .product-galleryies {
            height: 540px;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
        }

        .product-galleryies img {
            width: 100%;
            height: 100%;
            object-fit: contain;
        }

        @media (max-width: 768px) {
            .product-galleryies {
                height: 300px;
            }
        }

        @media (max-width: 480px) {
            .product-galleryies {
                height: 250px;
            }
        }

        .product-img {
            width: 100%;
            height: 40vh;
            object-fit: contain;
        }
    </style>
</head>

<body>
    <div class="wrapper">
        <div class="header-height-bar"></div>
        @include('frontend.layout.header')
        <main>
            @yield('content')
        </main>
        @include('frontend.layout.footer')
        @include('frontend.layout.modal')
    </div>
    @yield('script')
    <script src="{{ asset('frontend/assets/js/jquery-3.5.1.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/swiper/swiper-bundle.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/magnific/jquery.magnific-popup.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/isotope/isotope.pkgd.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/count-down/jquery.countdown.min.js') }}"></script>
    <script src="{{ asset('frontend/assets/vendor/jarallax/jarallax-all.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/custom.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/theme.js') }}"></script>
    <script src="{{ asset('frontend/assets/js/color-modes.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js"></script>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script>
        $(document).ready(function() {
            const input = document.querySelector("#mobile_no");
            const iti = window.intlTelInput(input, {
                separateDialCode: true,
                initialCountry: "auto",
                preferredCountries: ["in", "us", "gb", "ae"],
                utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
                geoIpLookup: function(callback) {
                    $.get('https://ipinfo.io', function() {}, "jsonp").always(function(resp) {
                        const countryCode = (resp && resp.country) ? resp.country : "in";
                        callback(countryCode);
                    });
                }
            });

            input.addEventListener("countrychange", function() {
                const countryData = iti.getSelectedCountryData();
                const shortCode = countryData.iso2.toUpperCase();
                const dialCode = countryData.dialCode;
                $('#country_code').val(shortCode + ' ' + '+' + dialCode);
                alert("Country: " + countryName + " (" + shortCode + ")\nCode: +" + dialCode);
            });

            $('#agreeCheck').on('change', function() {
                if ($(this).is(':checked')) {
                    $('#otpBtn').removeAttr('disabled');
                } else {
                    $('#otpBtn').attr('disabled', 'disabled');
                }
            });
        });
    </script>
    <script>
        $(document).ready(function() {
            $('.add-to-cart').on('click', function(e) {
                e.preventDefault();
                let quantity = Math.max(1, parseInt($('#qtybutton').val()) || 1);
                let product_id = $(this).data('id');
                $.ajax({
                    url: "{{ route('add-to-cart') }}",
                    type: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        qty: quantity,
                        id: product_id
                    },
                    success: function(response) {
                        if (response.status === true) {
                            window.location.href = response.redirect_url;
                        }
                        window.location.href = response.redirect_url;
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert("Something went wrong!");
                    }
                });
            });
        });
    </script>
</body>

</html>
