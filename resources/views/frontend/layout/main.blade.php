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
</head>

<body>
    <div class="wrapper">
        <div class="header-height-bar"></div>
        @include('frontend.layout.header')
        <main>
            @yield('content')
        </main>
        @include('frontend.layout.footer')
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
</body>

</html>
