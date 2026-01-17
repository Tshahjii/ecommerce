@if ($values->categories == 'Personal Care')
    <li class="dropdown dropdown-full nav-item">
        <a href="#" class="nav-link">{{ $values->categories }}</a>
        <label class="px-dropdown-toggle mob-menu"></label>
        <div class="dropdown-menu dropdown-mega-menu py-0">
            <div class="container-fluid p-3 p-lg-4">
                <div class="row gy-4">
                    <div class="col-12 col-md-3 col-xl-5 d-flex flex-row">
                        <div class="min-h-200px bg-center bg-cover d-flex align-items-center justify-content-center h-100 w-100"
                            style="
                          background-image: url(frontend/assets/img/fashion/blog-home-2.jpg);
                        ">
                            <div class="text-center px-4 py-3">
                                <h6 class="text-uppercase text-white mb-0 letter-spacing-4 fw-300">
                                    NEW IN
                                </h6>
                                <h3 class="fw-600 h4 text-white">2022 Collection</h3>
                                <div class="pt-2">
                                    <a class="btn btn-white btn-sm" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if ($values->child_category->count())
                        @foreach ($values->child_category as $child)
                            <div class="col-6 col-md-3 col-xl-2">
                                <h6 class="sm-title-05 mb-3 fw-500">{{ $child->child_category }}</h6>
                                @if ($child->sub_categories->count())
                                    <ul class="list-unstyled link-list-style-05 m-0">
                                        @foreach ($child->sub_categories as $sub)
                                            <li><a href="#">{{ $sub->sub_category }}</a></li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </li>
@endif
