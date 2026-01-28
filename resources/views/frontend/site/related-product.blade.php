 <section class="section bg-gray-100 mt-6 mt-lg-10">
     <div class="container">
         <div class="row justify-content-center mb-4 mb-lg-6">
             <div class="col-lg-6 text-center">
                 <h3 class="h2 mb-2">You might also like these</h3>
                 <p class="fs-6 m-0">Read Today’s News.</p>
             </div>
         </div>
         <div class="swiper-hover-arrow position-relative">
             <div class="swiper swiper-container"
                 data-swiper-options='{
                              "slidesPerView": 2,
                              "spaceBetween": 10,
                              "loop": true,
                              "pagination": {
                                "el": ".swiper-pagination",
                                "clickable": true
                                },
                              "navigation": {
                                "nextEl": ".swiper-next-02",
                                "prevEl": ".swiper-prev-02"
                              },
                              "autoplay": {
                                "delay": 3500,
                                "disableOnInteraction": false
                              },
                              "breakpoints": {
                                "600": {
                                  "slidesPerView": 3
                                },
                                "991": {
                                  "slidesPerView": 3,
                                  "spaceBetween": 10
                                },
                                "1200": {
                                  "slidesPerView": 4,
                                  "spaceBetween": 24
                                }
                              }
                        }'>
                 <div class="swiper-wrapper">
                     @if ($related->count())
                         @foreach ($related as $values)
                             <div class="swiper-slide">
                                 <div class="product-card-3">
                                     <div class="product-card-image">
                                         <div class="badge-ribbon">
                                             <span class="badge bg-danger">Sale</span>
                                         </div>
                                         <div class="product-action">
                                             <a href="#" class="btn btn-dark"><i
                                                     class="fa-sharp fa-regular fa-heart"></i>
                                             </a><a href="#" class="btn btn-dark"><i
                                                     class="fa-solid fa-repeat"></i>
                                             </a><a data-bs-toggle="modal" data-bs-target="#px-quick-view"
                                                 href="javascript:void(0)" data-id="{{ $values->id }}"
                                                 class="btn btn-dark show-product-details"><i
                                                     class="fa-solid fa-eye"></i>
                                             </a><a data-bs-toggle="modal" data-bs-target="#px-quick-view"
                                                 href="javascript:void(0)" class="btn btn-dark"><i
                                                     class="fa-regular fa-cart-shopping-fast"></i></a>
                                         </div>
                                         <div class="product-media">
                                             <a href="{{ route('product-detail', ['id' => encrypt($values->id)]) }}">
                                                 <img class="img-fluid product-img"
                                                     src="{{ $values->firstProductImage
                                                         ? asset('backend/upload/image/product/' . $values->product_slug . '/' . $values->firstProductImage->image_path)
                                                         : asset('backend/assets/images/default_image.jpg') }}"
                                                     alt="" /></a>
                                         </div>
                                     </div>
                                     <div class="product-card-info">
                                         <h6 class="product-title">
                                             <a href="#">{{ $values->product_title }}</a>
                                         </h6>
                                         @php
                                             $price = number_format($values->product_price, 2);
                                             $priceParts = explode('.', $price);
                                             $compare = number_format($values->compare_price, 2);
                                             $compareParts = explode('.', $compare);
                                         @endphp
                                         <div class="product-price">
                                             <span
                                                 class="text-primary">₹{{ $priceParts[0] }}.<small>{{ $priceParts[1] }}</small></span>
                                             <del
                                                 class="fs-sm text-muted">₹{{ $compareParts[0] }}.<small>{{ $compareParts[1] }}</small></del>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     @endif
                 </div>
                 <div class="swiper-pagination mt-4 d-lg-none position-relative"></div>
             </div>
             <div class="swiper-arrow-style-02 swiper-next swiper-next-02">
                 <i class="bi bi-chevron-right"></i>
             </div>
             <div class="swiper-arrow-style-02 swiper-prev swiper-prev-02">
                 <i class="bi bi-chevron-left"></i>
             </div>
         </div>
     </div>
 </section>
