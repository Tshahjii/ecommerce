@if ($values->categories == 'Bestsellers')
    <li class="dropdown dropdown-full nav-item">
        <a href="#" class="nav-link">{{ $values->categories }}</a>
        <label class="px-dropdown-toggle mob-menu"></label>
        <div class="dropdown-menu dropdown-mega-menu py-0">
            <div class="container-fluid p-3 p-lg-4">
                <div class="row gy-4">
                    <div class="col-lg-6">
                        <div class="row gy-4">
                            @if ($values->child_category->count())
                                @foreach ($values->child_category as $child)
                                    <div class="col-6">
                                        <h6 class="sm-title-04">
                                            <a class="text-reset" href="#">{{ $child->child_category }}</a>
                                        </h6>
                                        @if ($child->sub_categories->count())
                                            <ul class="list-unstyled link-list-style-03">
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
                    <div class="col-lg-6 d-flex flex-column">
                        <div class="rounded h-100 bg-cover bg-no-repeat d-flex align-items-center justify-content-center py-8 p-xl-5"
                            style="
                              background-image: url(frontend/assets/img/fashion/blog-home-3.jpg);
                            ">
                            <div class="w-100 text-center">
                                <h6 class="text-uppercase fw-300 text-white mb-2">
                                    NEW IN
                                </h6>
                                <h3 class="fw-400 h3 text-white">
                                    New Exclusive<br />2022 Collection
                                </h3>
                                <div class="pt-2">
                                    <a class="btn btn-white btn-sm" href="#">Shop Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </li>
@endif
