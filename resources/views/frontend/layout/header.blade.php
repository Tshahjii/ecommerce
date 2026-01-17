    <header class="header-main bg-mode-re header-light fixed-top header-height header-option-1">
        <div class="header-top small bg-black small">
            <div class="container">
                <div class="d-flex justify-content-between align-items-center">
                    <div class="d-flex align-items-center justify-content-center d-none d-lg-block">
                        <ul class="nav white-link">
                            <li class="nav-item me-3 text-white text-opacity-85">
                                <span><i class="bi bi-clock me-2"></i> Visit time: Mon-Sat
                                    9:00-19:00</span>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="navbar-link"><i class="bi bi-headset me-2"></i> Call us now:
                                    +01
                                    035-477-5588</a>
                            </li>
                        </ul>
                    </div>
                    <div class="d-flex align-items-center justify-content-center w-100 w-lg-auto">
                        <div class="dropdown ms-0 ms-lg-3">
                            <a class="dropdown-toggle text-white" href="#" role="button" id="dropdown_language"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><img class="me-2"
                                    width="20" src="{{ asset('/backend/assets/images/flags/india.webp') }}"
                                    alt="" />
                                Eng</a>
                            <div class="dropdown-menu mt-2 shadow" aria-labelledby="dropdown_language"
                                style="margin: 0px">
                                <div class="dropdown-item">
                                    <select class="form-select form-select-sm">
                                        <option value="usd">$ USD</option>
                                        <option value="eur">€ EUR</option>
                                        <option value="ukp">£ UKP</option>
                                        <option value="jpy">¥ JPY</option>
                                    </select>
                                </div>
                                <a class="dropdown-item" href="#"><img class="me-2" width="20"
                                        src="https://www.pxdraft.com/wrap/shopapp/assets/img/flags/sp.svg"
                                        alt="" />
                                    Español</a>
                                <a class="dropdown-item" href="#"><img class="me-2" width="20"
                                        src="https://www.pxdraft.com/wrap/shopapp/assets/img/flags/fr.svg"
                                        alt="" />
                                    Français</a>
                                <a class="dropdown-item" href="#"><img class="me-2" width="20"
                                        src="https://www.pxdraft.com/wrap/shopapp/assets/img/flags/gr.svg"
                                        alt="" />
                                    Deutsch</a>
                            </div>
                        </div>
                        <!-- Top link -->
                        <ul class="nav ms-auto ms-lg-3 align-items-center">
                            <li class="nav-item">
                                <a href="{{ route('sign-in') }}" class="nav-link text-white">
                                    <i class="fa-regular fa-user me-2"></i>Hello,
                                    {{ Auth::user()->name ?? 'Sign in' }}<br>
                                    <span class="ms-1 fw-bold" style="font-size:12px;">Account & List</span>
                                </a>
                            </li>
                            <li class="nav-item">
                                <a href="#" class="nav-link text-white" data-bs-toggle="modal"
                                    data-bs-target="#topbarlogin">
                                    <i class="fa-etch fa-solid fa-arrow-up-wide-short me-2"></i>Returns<br>
                                    <span class="ms-1 fw-bold" style="font-size:12px;">& Orders</span>
                                </a>
                            </li>
                            <style>
                                .cart-icon {
                                    margin-top: 10px;
                                    font-size: 30px;
                                    color: white;
                                }

                                .cart-count-badge {
                                    position: absolute;
                                    top: 16px;
                                    left: 25px;
                                    color: rgb(255, 140, 0);
                                    font-size: 20px;
                                    font-weight: bold;
                                    border-radius: 50%;
                                    padding: 1px 6px;
                                    line-height: 1;
                                }
                            </style>
                            <li class="nav-item position-relative">
                                <a href="#" class="nav-link text-white position-relative" data-bs-toggle="modal"
                                    data-bs-target="#topbarlogin">

                                    <i class="fa-solid fa-cart-flatbed-empty cart-icon"></i>
                                    <!-- Cart Count Badge -->
                                    <span class="cart-count-badge">
                                        25
                                    </span>

                                    <span class="ms-1" style="font-size: 12px;font-weight:bold;">Cart</span>
                                </a>
                            </li>

                        </ul>

                    </div>
                </div>
            </div>
        </div>
        <!-- End Header Top -->
        <nav class="navbar navbar-expand-lg navbar-light d-none d-lg-flex">
            <div class="container">
                <!-- Logo -->
                <a class="navbar-brand" href="{{ route('home-page') }}">
                    <img class="logo-dark" src="{{ asset('frontend/assets/img/logo.png') }}" title=""
                        alt="" width="150" height="55" />
                    <img class="logo-light" src="{{ asset('frontend/assets/img/logo_light.png') }}" title=""
                        alt="" width="150" height="55" /> </a><!-- Logo --><!-- Menu -->
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    @php
                        $menus = isHomeHeader();
                    @endphp

                    <ul class="navbar-nav mx-auto">
                        @if ($menus->count())
                            @foreach ($menus as $values)
                                @include('frontend.layout.header1', ['values' => $values])
                                @include('frontend.layout.header2', ['values' => $values])
                                @include('frontend.layout.header3', ['values' => $values])
                                @include('frontend.layout.header4', ['values' => $values])
                                @include('frontend.layout.header5', ['values' => $values])
                                @include('frontend.layout.header6', ['values' => $values])
                                @include('frontend.layout.header7', ['values' => $values])
                            @endforeach
                        @endif
                    </ul>
                </div>
                <!-- End Menu -->
                <div class="nav flex-nowrap align-items-center header-right">
                    <!-- Nav Search-->
                    <div class="nav-item">
                        <a class="nav-link collapsed" data-bs-toggle="collapse" href="javascript:void(0)"
                            data-bs-target="#search-open" aria-expanded="false"><i
                                class="fa-solid fa-magnifying-glass"></i></a>
                    </div>
                    <!-- Acount -->
                    <div class="nav-item dropdown">
                        <a class="nav-link" href="#" role="button" id="dropdown_myaccount"
                            data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i
                                class="fa-regular fa-user"></i></a>
                        <div class="dropdown-menu dropdown-menu-end mt-2 shadow" aria-labelledby="dropdown_myaccount">
                            <a class="dropdown-item" href="#">Login</a>
                            <a class="dropdown-item" href="#">Wishlist</a>
                            <a class="dropdown-item" href="#">My account</a>
                        </div>
                    </div>
                    <!-- Wishlist -->
                    <div class="nav-item d-none d-xl-block">
                        <a class="nav-link" href="#"><i class="fa-regular fa-heart"></i></a>
                    </div>
                    <!-- Cart -->
                    <div class="nav-item">
                        <a class="nav-link" data-bs-toggle="offcanvas" href="#modalMiniCart" role="button"
                            aria-controls="modalMiniCart"><span class="" data-cart-items="8"><i
                                    class="fa-regular fa-cart-shopping-fast"></i></span></a>
                    </div>
                </div>
            </div>
        </nav>
        <!-- Mobile Menu -->
        <div class="mobile-header-01 d-lg-none">
            <div class="mob-head-in">
                <div class="mob-toggle">
                    <button class="hm-toggle-mob" type="button" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvas_mobile_header_01" aria-controls="offcanvas_mobile_header_01">
                        <span></span>
                    </button>
                </div>
                <div class="mob-logo text-center w-100 d-flex justify-content-center">
                    <a href="https://www.pxdraft.com/wrap/shopapp/index.html"><img class="logo-dark"
                            src="{{ asset('frontend/assets/img/logo.png') }}" title="" alt=""
                            width="150" height="55" />
                        <img class="logo-light" src="{{ asset('frontend/assets/img/logo_light.png') }}"
                            title="" alt="" width="150" height="55" /></a>
                </div>
                <div class="mob-end">
                    <!-- Cart -->
                    <div class="nav-item">
                        <a class="nav-link" data-bs-toggle="offcanvas" href="#modalMiniCart" role="button"
                            aria-controls="modalMiniCart"><i class="fa-regular fa-cart-shopping-fast"></i>
                            <sub>08</sub></a>
                    </div>
                </div>
            </div>
        </div>
        <!-- End Mobile Menu -->
    </header>
    <!-- Mobile Bottom --><!-- Header Bottom -->
    <div class="mob-header-btn-fixed-01 d-lg-none">
        <div class="mob-hb-in">
            <div class="mob-hb-item">
                <a class="mob-hb-link" href="#"><i class="fi-grid"></i> <span>Shop</span></a>
            </div>
            <div class="mob-hb-item">
                <a class="mob-hb-link" data-bs-toggle="offcanvas" href="#header_search_popup" role="button"
                    aria-controls="header_search_popup"><i class="fa-solid fa-magnifying-glass"></i>
                    <span>Search</span></a>
            </div>
            <div class="mob-hb-item">
                <a href="#" class="mob-hb-link" data-bs-toggle="modal" data-bs-target="#topbarlogin"><i
                        class="fa-regular fa-user"></i>
                    <span>Login</span></a>
            </div>
            <div class="mob-hb-item">
                <a href="#" class="mob-hb-link"><i class="fa-regular fa-heart"><sub>08</sub></i>
                    <span>Wishlist</span></a>
            </div>
            <div class="mob-hb-item">
                <a class="mob-hb-link" data-bs-toggle="offcanvas" href="#modalMiniCart" role="button"
                    aria-controls="modalMiniCart"><i class="fa-regular fa-cart-shopping-fast"><sub>08</sub></i>
                    <span>Cart</span></a>
            </div>
        </div>
    </div>
    <!-- End Header Bottom --><!-- Mobile  -->
    <div class="offcanvas-lg mobile-nav-offcanvas offcanvas-start d-lg-none @@MobExtraClass" tabindex="-1"
        id="offcanvas_mobile_header_01" aria-labelledby="offcanvas_mobile_header_01">
        <div class="offcanvas-header">
            <div class="offcanvas-header-overlay"></div>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas"
                data-bs-target="#offcanvas_mobile_header_01" aria-label="Close">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="mob-user">
                <a href="#"><i class="fa-regular fa-user"></i> <span>Login</span></a>
            </div>
            <ul class="mob-extra">
                <li class="nav-item">
                    <a href="#" class="nav-link"><i class="fa-regular fa-heart"></i> <span>Wishlist</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link dropdown-toggle text-white" href="#" role="button"
                        id="dropdown_language" data-bs-toggle="dropdown" aria-haspopup="true"
                        aria-expanded="false"><img width="20"
                            src="{{ asset('/backend/assets/images/flags/india.webp') }}" alt="" />
                        Eng</a>
                    <div class="dropdown-menu mt-2 shadow" aria-labelledby="dropdown_language" style="margin: 0px">
                        <div>
                            <select class="form-select form-select-sm">
                                <option value="usd">$ USD</option>
                                <option value="eur">€ EUR</option>
                                <option value="ukp">£ UKP</option>
                                <option value="jpy">¥ JPY</option>
                            </select>
                        </div>
                        <a class="dropdown-item" href="#"><img class="me-2" width="20"
                                src="https://www.pxdraft.com/wrap/shopapp/assets/img/flags/sp.svg" alt="" />
                            Español</a>
                        <a class="dropdown-item" href="#"><img class="me-2" width="20"
                                src="https://www.pxdraft.com/wrap/shopapp/assets/img/flags/fr.svg" alt="" />
                            Français</a>
                        <a class="dropdown-item" href="#"><img class="me-2" width="20"
                                src="https://www.pxdraft.com/wrap/shopapp/assets/img/flags/gr.svg" alt="" />
                            Deutsch</a>
                    </div>
                </li>
            </ul>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav mx-auto">
                @if ($menus->count())
                    @foreach ($menus as $values)
                        @include('frontend.layout.mobile_nav1', ['values' => $values])
                        @include('frontend.layout.mobile_nav2', ['values' => $values])
                        @include('frontend.layout.mobile_nav3', ['values' => $values])
                        @include('frontend.layout.mobile_nav4', ['values' => $values])
                        @include('frontend.layout.mobile_nav5', ['values' => $values])
                        @include('frontend.layout.mobile_nav6', ['values' => $values])
                        @include('frontend.layout.mobile_nav7', ['values' => $values])
                    @endforeach
                @endif
            </ul>
        </div>
    </div>
