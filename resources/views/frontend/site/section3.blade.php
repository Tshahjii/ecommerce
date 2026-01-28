 <section class="section pt-0">
     <div class="container">
         <div class="section-heading section-heading-01">
             <div class="row align-items-center">
                 <div class="col-auto col-md-6">
                     <h3 class="h4 mb-0">Hot Trending Products</h3>
                 </div>
                 <div class="col-auto col-md-6 text-end"><a href="#">View All <i class="bi bi-arrow-right"></i></a>
                 </div>
             </div>
         </div>
         <div class="swiper-hover-arrow position-relative">
             <div class="swiper swiper-container"
                 data-swiper-options='{
                              "slidesPerView": 2,
                              "spaceBetween": 24,
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
                                  "slidesPerView": 4
                                },
                                "1200": {
                                  "slidesPerView": 6
                                }
                              }
                        }'>
                 <div class="swiper-wrapper">
                     @php
                         $sarees = sareesProduct();
                     @endphp
                     @if (!empty($sarees))
                         @foreach ($sarees as $values)
                             <div class="swiper-slide">
                                 <div class="product-card-8">
                                     <div class="product-card-image">
                                         <div class="badge-ribbon"><span class="badge bg-danger">Sale</span></div>
                                         <div class="product-action"><a href="#"
                                                 class="btn btn-outline-primary"><i
                                                     class="fa-sharp fa-regular fa-heart"></i>
                                             </a><a href="#" class="btn btn-outline-primary"><i
                                                     class="fa-solid fa-repeat"></i>
                                             </a><a data-bs-toggle="modal" data-bs-target="#px-quick-view"
                                                 href="javascript:void(0)" data-id="{{ $values->id }}"
                                                 class="btn btn-outline-primary show-product-details"><i
                                                     class="fa-solid fa-eye"></i></a>
                                         </div>
                                         <div class="product-media"><a
                                                 href="{{ route('product-detail', ['id' => encrypt($values->id)]) }}"><img
                                                     class="img-fluid shahproduct-img"
                                                     src="{{ $values->firstProductImage
                                                         ? asset('backend/upload/image/product/' . $values->product_slug . '/' . $values->firstProductImage->image_path)
                                                         : asset('backend/assets/images/default_image.jpg') }}"
                                                     title="" alt=""></a></div>
                                     </div>
                                     <div class="product-card-info">
                                         <div class="rating-star text"><i class="bi bi-star-fill active"></i> <i
                                                 class="bi bi-star-fill active"></i> <i
                                                 class="bi bi-star-fill active"></i> <i
                                                 class="bi bi-star-fill active"></i> <i class="bi bi-star"></i></div>
                                         <h6 class="product-title"><a href="#">{{ $values->product_title }}</a>
                                         </h6>
                                         @php
                                             $price = number_format($values->product_price, 2);
                                             $priceParts = explode('.', $price);
                                             $compare = number_format($values->compare_price, 2);
                                             $compareParts = explode('.', $compare);
                                         @endphp
                                         <div class="product-price"><span class="text-primary">
                                                 ₹{{ $priceParts[0] }}.<small>{{ $priceParts[1] }}</small>
                                             </span>
                                             <del class="fs-sm text-muted">
                                                 ₹{{ $compareParts[0] }}.<small>{{ $compareParts[1] }}</small>
                                             </del>
                                         </div>
                                         <div class="product-cart-btn">
                                             <a href="javascript:void(0);" data-id="{{ $values->id }}"
                                                 class="btn btn-primary btn-sm w-100 add-to-cart">
                                                 <i class="fa-solid fa-cart-shopping"></i> Add to cart
                                             </a>
                                         </div>
                                     </div>
                                 </div>
                             </div>
                         @endforeach
                     @endif
                 </div>
                 <div class="swiper-pagination mt-4 d-lg-none position-relative"></div>
             </div>
             <div class="swiper-arrow-style-02 swiper-next swiper-next-02"><i class="bi bi-chevron-right"></i></div>
             <div class="swiper-arrow-style-02 swiper-prev swiper-prev-02"><i class="bi bi-chevron-left"></i></div>
         </div>
     </div>
 </section>
