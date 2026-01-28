@if ($values->categories == 'All')
    <li class="dropdown nav-item vertical-dropdown"><a href="index.html" class="nav-link"><i class="bi bi-grid-3x3-gap"></i>
            {{ $values->categories }}</a> <label class="px-dropdown-toggle mob-menu"></label>
        @if ($values->children->count())
            <ul class="vertical-dropdown-menu dropdown-menu left shadow-none">
                @foreach ($values->children as $child)
                    @if ($child->categories == 'Gifts & Toys')
                        <li><a class="dropdown-item" href="#"><i class="bi bi-gift me-2"></i>
                                <span>{{ $child->categories }}</span></a>
                            <label class="px-dropdown-toggle mob-menu"></label>
                            <div class="vertical-mm-in">
                                <div class="row gy-4">
                                    @if ($child->child_category->count())
                                        @foreach ($child->child_category as $child_cat)
                                            <div class="col-6 col-md-4 col-lg-3">
                                                <h6 class="sm-title-04"><a class="text-reset"
                                                        href="#">{{ $child_cat->child_category }}</a>
                                                </h6>
                                                @if ($child_cat->sub_categories->count())
                                                    <ul class="list-unstyled link-list-style-03">
                                                        @foreach ($child_cat->sub_categories as $sub)
                                                            <li><a href="#">{{ $sub->sub_category }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div><!-- Product section -->
                                <div class="row gy-4 pt-5">
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="p-2 rounded d-flex align-items-center position-relative hover-scale"
                                            style="background-color: #eee;">
                                            <div class="col ps-2 pe-4">
                                                <h5 class="mb-0"><a href="#"
                                                        class="stretched-link text-reset">iPhone
                                                        12</a>
                                                </h5><span>2
                                                    items</span>
                                            </div>
                                            <div class="avatar avatar-xl hover-scale-in"><img height="80"
                                                    src="{{ asset('frontend/assets/img/electronic/iphone_12.png') }}"
                                                    title="" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="p-2 rounded d-flex align-items-center position-relative hover-scale"
                                            style="background-color: #eee;">
                                            <div class="col ps-2 pe-4">
                                                <h5 class="mb-0"><a href="#"
                                                        class="stretched-link text-reset">iPhone
                                                        13</a>
                                                </h5><span>2
                                                    items</span>
                                            </div>
                                            <div class="avatar avatar-xl hover-scale-in"><img height="80"
                                                    src="{{ asset('frontend/assets/img/electronic/iphone_13.png') }}"
                                                    title="" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="p-2 rounded d-flex align-items-center position-relative hover-scale"
                                            style="background-color: #eee;">
                                            <div class="col ps-2 pe-4">
                                                <h5 class="mb-0"><a href="#"
                                                        class="stretched-link text-reset">iOs
                                                        15</a>
                                                </h5>
                                                <span>2
                                                    items</span>
                                            </div>
                                            <div class="avatar avatar-xl hover-scale-in"><img height="80"
                                                    src="{{ asset('frontend/assets/img/electronic/iphone_ios.png') }}"
                                                    title="" alt="">
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6 col-md-4 col-lg-3">
                                        <div class="p-2 rounded d-flex align-items-center position-relative hover-scale"
                                            style="background-color: #eee;">
                                            <div class="col ps-2 pe-4">
                                                <h5 class="mb-0"><a href="#"
                                                        class="stretched-link text-reset">Shop
                                                        More</a>
                                                </h5><span>2
                                                    items</span>
                                            </div>
                                            <div class="avatar avatar-xl hover-scale-in"><img height="80"
                                                    src="{{ asset('frontend/assets/img/electronic/shop_iphone.png') }}"
                                                    title="" alt="">
                                            </div>
                                        </div>
                                    </div>
                                </div><!-- End Product section -->
                            </div>
                        </li>
                    @elseif($child->categories == 'Electronics & Gadgets')
                        <li><a class="dropdown-item" href="#"><i class="bi bi-laptop me-2"></i>
                                <span>{{ $child->categories }}</span></a>
                            <label class="px-dropdown-toggle mob-menu"></label>
                            <div class="vertical-mm-in">
                                <div class="row gy-4">
                                    @if ($child->child_category->count())
                                        @foreach ($child->child_category as $child_cat)
                                            <div class="col-6 col-md-4 col-lg-3">
                                                <div class="hover-scale overflow-hidden mb-4 rounded"><a href="#"
                                                        class="hover-scale-in d-block"><img class="card-img-top"
                                                            src="{{ asset('backend/upload/image/child-category/' . $child_cat->img_path) }}"
                                                            title="" alt=""></a></div>
                                                <h6 class="sm-title-04"><a class="text-reset"
                                                        href="#">{{ $child_cat->child_category }}</a>
                                                </h6>
                                                @if ($child_cat->sub_categories->count())
                                                    <ul class="list-unstyled link-list-style-03">
                                                        @foreach ($child_cat->sub_categories as $sub)
                                                            <li><a href="#">{{ $sub->sub_category }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </li>
                    @elseif($child->categories == 'Fashion & Accessories')

                    @elseif($child->categories == 'Bags & Shoes')
                        <li><a class="dropdown-item" href="#"><i class="bi bi-bag me-2"></i>
                                <span>{{ $child->categories }}</span></a>
                            <label class="px-dropdown-toggle mob-menu"></label>
                            <div class="vertical-mm-in">
                                <div class="row gy-4">
                                    @if ($child->child_category->count())
                                        @foreach ($child->child_category as $child_cat)
                                            <div class="col-6 col-md-4 col-lg-3">
                                                <h6 class="sm-title-04"><a class="text-reset"
                                                        href="#">{{ $child_cat->child_category }}</a></h6>
                                                @if ($child_cat->sub_categories->count())
                                                    <ul class="list-unstyled link-list-style-03">
                                                        @foreach ($child_cat->sub_categories as $sub)
                                                            <li><a href="#">{{ $sub->sub_category }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                                <div class="row g-0 px-4 px-lg-5 py-3 align-items-center rounded bg-cover bg-fiex bg-center border mt-4"
                                    style="background-image: url('{{ asset('frontend/assets/img/electronic/el-banner-6.jpg') }}');">
                                    <div class="col-md-8 my-3 text-center text-md-start">
                                        <h3 class="h3 text-white m-0">Eat clean &amp; green. Eat Organic.</h3>
                                    </div>
                                    <div class="col-md-4 my-3 text-center text-md-end"><a class="btn btn-white"
                                            href="#" tabindex="0">Discover More</a></div>
                                </div>
                            </div>
                        </li>
                    @elseif($child->categories == 'Optimum Electronics')
                        <li><a class="dropdown-item" href="#"><i class="bi bi-watch me-2"></i>
                                <span>{{ $child->categories }}</span></a> <label
                                class="px-dropdown-toggle mob-menu"></label>
                            <div class="vertical-mm-in">
                                <div class="row gy-4">
                                    @php
                                        $bgColors = ['#ffe1db', '#e1f0ff', '#e1ffe7', '#fff4e1', '#f0e1ff', '#e1fff9'];
                                    @endphp
                                    @if ($child->child_category->count())
                                        @foreach ($child->child_category as $child_cat)
                                            @php
                                                $randomColor = $bgColors[array_rand($bgColors)];
                                            @endphp
                                            <div class="col-lg-3">
                                                <div class="px-4 position-relative pt-5 text-center rounded"
                                                    style="background-color: {{ $randomColor }};">
                                                    <div class="pb-1">
                                                        <h6 style="color: #f62b22;">New Arrival</h6>
                                                        <h3 class="m-0 h5">{{ $child_cat->child_category }}<br>30% off
                                                        </h3>
                                                    </div>
                                                    <a href="#" class="stretched-link"><img
                                                            src="{{ asset('backend/upload/image/child-category/' . $child_cat->img_path) }}"
                                                            title="" alt=""></a>
                                                </div>
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </li>
                    @elseif($child->categories == 'Health & Bueaty')
                        <li><a class="dropdown-item" href="#"><i class="fa-sharp fa-regular fa-heart me-2"></i>
                                <span>{{ $child->categories }}</span></a>
                            <label class="px-dropdown-toggle mob-menu"></label>
                            <div class="vertical-mm-in">
                                <div class="row g-0 px-4 px-lg-5 py-3 align-items-center rounded bg-cover bg-fiex bg-center border mb-4"
                                    style="background-image: url('{{ asset('frontend/assets/img/electronic/el-banner-6.jpg') }}');">
                                    <div class="col-md-8 my-3 text-center text-md-start">
                                        <h3 class="h3 text-white m-0">Eat clean &amp; green. Eat Organic.</h3>
                                    </div>
                                    <div class="col-md-4 my-3 text-center text-md-end"><a class="btn btn-white"
                                            href="#" tabindex="0">Discover More</a></div>
                                </div>
                                <div class="row gy-4">
                                    @if ($child->child_category->count())
                                        @foreach ($child->child_category as $child_cat)
                                            <div class="col-6 col-md-4 col-lg-3">
                                                <h6 class="sm-title-04"><a class="text-reset"
                                                        href="#">{{ $child_cat->child_category }}</a>
                                                </h6>
                                                @if ($child_cat->sub_categories->count())
                                                    <ul class="list-unstyled link-list-style-03">
                                                        @foreach ($child_cat->sub_categories as $sub)
                                                            <li><a href="#">{{ $sub->sub_category }}</a></li>
                                                        @endforeach
                                                    </ul>
                                                @endif
                                            </div>
                                        @endforeach
                                    @endif
                                </div>
                            </div>
                        </li>
                    @elseif($child->categories == 'Home & Lights')
                        <li><a class="dropdown-item" href="#"><i class="bi bi-house-door me-2"></i>
                                <span>{{ $child->categories }}</span></a> <label
                                class="px-dropdown-toggle mob-menu"></label>
                            <div class="vertical-mm-in">
                                <div class="row gy-4">
                                    <div class="col-lg-6">
                                        <div class="row gy-4">
                                            @if ($child->child_category->count())
                                                @foreach ($child->child_category as $child_cat)
                                                    <div class="col-6">
                                                        <h6 class="sm-title-04"><a class="text-reset"
                                                                href="#">{{ $child_cat->child_category }}</a>
                                                        </h6>
                                                        @if ($child_cat->sub_categories->count())
                                                            <ul class="list-unstyled link-list-style-03">
                                                                @foreach ($child_cat->sub_categories as $sub)
                                                                    <li><a href="#">{{ $sub->sub_category }}</a>
                                                                    </li>
                                                                @endforeach
                                                            </ul>
                                                        @endif
                                                    </div>
                                                @endforeach
                                            @endif
                                        </div>
                                    </div>
                                    <div class="col-lg-6 d-flex flex-column">
                                        <div class="rounded h-100 bg-cover bg-no-repeat d-flex align-items-center justify-content-center py-8 p-xl-5"
                                            style="background-image: url('{{ asset('frontend/assets/img/electronic/el-banner-2.jpg') }}');">
                                            <div class="w-100 text-center">
                                                <h6 class="text-uppercase fw-300 text-white mb-2">NEW IN</h6>
                                                <h3 class="fw-400 h3 text-white">Canyon<br>Star Raider</h3>
                                                <div class="pt-2"><a class="btn btn-white btn-sm"
                                                        href="#">Shop
                                                        Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @elseif($child->categories == 'Industrial Parts')
                        <li><a class="dropdown-item" href="#"><i class="bi bi-command me-2"></i>
                                <span>Industrial
                                    Parts</span></a> <label class="px-dropdown-toggle mob-menu"></label>
                            <div class="vertical-mm-in">
                                <div class="row g-3">
                                    <div class="col-lg-4">
                                        <div class="min-h-250px bg-center bg-cover rounded d-flex flex-column align-items-center justify-content-center"
                                            style="background-image: url('{{ asset('frontend/assets/img/electronic/el-banner-1.jpg') }}');">
                                            <div class="w-100 text-center">
                                                <h6 class="text-uppercase fw-300 text-white mb-2">NEW IN</h6>
                                                <h3 class="fw-400 h3 text-white">Canyon<br>Star Raider</h3>
                                                <div class="pt-2"><a class="btn btn-white btn-sm"
                                                        href="#">Shop
                                                        Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="min-h-250px bg-center bg-cover rounded d-flex flex-column align-items-center justify-content-center"
                                            style="background-image: url('{{ asset('frontend/assets/img/electronic/el-banner-2.jpg') }}');">
                                            <div class="w-100 text-center">
                                                <h6 class="text-uppercase fw-300 text-white mb-2">NEW IN</h6>
                                                <h3 class="fw-400 h3 text-white">Canyon<br>Star Raider</h3>
                                                <div class="pt-2"><a class="btn btn-white btn-sm"
                                                        href="#">Shop
                                                        Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="min-h-250px bg-center bg-cover rounded d-flex flex-column align-items-center justify-content-center"
                                            style="background-image: url('{{ asset('frontend/assets/img/electronic/el-banner-3.jpg') }}');">
                                            <div class="w-100 text-center">
                                                <h6 class="text-uppercase fw-300 text-white mb-2">NEW IN</h6>
                                                <h3 class="fw-400 h3 text-white">Canyon<br>Star Raider</h3>
                                                <div class="pt-2"><a class="btn btn-white btn-sm"
                                                        href="#">Shop
                                                        Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="min-h-250px bg-center bg-cover rounded d-flex flex-column align-items-center justify-content-center"
                                            style="background-image: url('{{ asset('frontend/assets/img/electronic/el-banner-4.jpg') }}');">
                                            <div class="w-100 text-center">
                                                <h6 class="text-uppercase fw-300 text-white mb-2">NEW IN</h6>
                                                <h3 class="fw-400 h3 text-white">Canyon<br>Star Raider</h3>
                                                <div class="pt-2"><a class="btn btn-white btn-sm"
                                                        href="#">Shop
                                                        Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="min-h-250px bg-center bg-cover rounded d-flex flex-column align-items-center justify-content-center"
                                            style="background-image: url('{{ asset('frontend/assets/img/electronic/el-banner-5.jpg') }}');">
                                            <div class="w-100 text-center">
                                                <h6 class="text-uppercase fw-300 text-white mb-2">NEW IN</h6>
                                                <h3 class="fw-400 h3 text-white">Canyon<br>Star Raider</h3>
                                                <div class="pt-2"><a class="btn btn-white btn-sm"
                                                        href="#">Shop
                                                        Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-lg-4">
                                        <div class="min-h-250px bg-center bg-cover rounded d-flex flex-column align-items-center justify-content-center"
                                            style="background-image: url('{{ asset('frontend/assets/img/electronic/el-banner-6.jpg') }}');">
                                            <div class="w-100 text-center">
                                                <h6 class="text-uppercase fw-300 text-white mb-2">NEW IN</h6>
                                                <h3 class="fw-400 h3 text-white">Canyon<br>Star Raider</h3>
                                                <div class="pt-2"><a class="btn btn-white btn-sm"
                                                        href="#">Shop
                                                        Now</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                    @endif
                @endforeach
            </ul>
        @endif
    </li>
@endif
