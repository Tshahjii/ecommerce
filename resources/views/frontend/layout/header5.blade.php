 @if ($values->categories == 'Collections')
     <li class="dropdown dropdown-full nav-item">
         <a href="#" class="nav-link">{{ $values->categories }}</a>
         <label class="px-dropdown-toggle mob-menu"></label>
         <div class="dropdown-menu dropdown-mega-menu py-0">
             <div class="container-fluid p-3 p-lg-4">
                 <div class="row gy-4">
                     @if ($values->child_category->count())
                         @foreach ($values->child_category as $child)
                             <div class="col-6 col-md-4 col-lg-2">
                                 <div class="hover-scale position-relative mb-3">
                                     <div class="hover-scale-in">
                                         <a href="#"><img
                                                 src="{{ asset('frontend/assets/img/fashion3/shop-banner-12.jpg') }}"
                                                 title="" alt="" /></a>
                                     </div>
                                     <div class="pt-2 text-center position-absolute bottom-0 start-0 mb-3">
                                         <h5 class="m-0 h6 bg-body px-3 py-2">
                                             <a class="text-reset link-effect"
                                                 href="#">{{ $child->child_category }}</a>
                                         </h5>
                                     </div>
                                 </div>
                                 @if ($child->sub_categories->count())
                                     <ul class="list-unstyled link-list-style-02">
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
