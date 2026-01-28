<div class="modal-quick-view modal fade" id="px-quick-view" tabindex="-1">
    <div class="modal-dialog modal-dialog-centered modal-xl">
        <div class="modal-content"><button class="btn-close position-absolute end-0 top-0 me-2 mt-2 z-index-1"
                type="button" data-bs-dismiss="modal" aria-label="Close"></button>
            <div class="modal-body p-3">
                <div class="row"><!-- Product Gallery -->
                    <div class="col-lg-6 lightbox-gallery product-gallery product-galleryies">
                        <img src="" class="img-fluid product-gallery-details" title="" alt="">
                    </div>
                    <div class="col-lg-6">
                        <div class="product-detail pt-4">
                            <div class="products-brand pb-2"><span id="brand-name"></span></div>
                            <div class="products-title mb-2">
                                <h1 class="h4">Product Title Here</h1>
                            </div>
                            <div class="rating-star text small pb-4"><i class="bi bi-star-fill active"></i> <i
                                    class="bi bi-star-fill active"></i> <i class="bi bi-star-fill active"></i> <i
                                    class="bi bi-star-fill active"></i> <i class="bi bi-star"></i> <small>(4 Reviews
                                    )</small></div>
                            <div class="product-description">
                                <p>Lorem ipsum dolor sit amet, consectetur adipisic elit eiusm tempor incidid ut labore
                                    et dolore
                                    magna aliqua. Ut enim ad minim venialo quis nostrud exercitation ullamco</p>
                            </div>
                            <div class="product-price fs-3 fw-500 mb-2">
                            </div>
                            <div class="product-detail-actions d-flex flex-wrap pt-3">
                                <div class="cart-qty me-3 mb-3">
                                    <div class="dec qty-btn">-</div><input class="cart-qty-input form-control"
                                        type="text" name="qtybutton" value="1">
                                    <div class="inc qty-btn">+</div>
                                </div>
                                <div class="cart-button mb-3 d-flex"><button class="btn btn-mode me-3"><i
                                            class="fi-shopping-cart"></i> Add to cart</button> <button
                                        class="btn btn-outline-primary me-3"><i
                                            class="fa-sharp fa-regular fa-heart"></i></button> <button
                                        class="btn btn-outline-primary"><i
                                            class="fa-regular fa-cart-shopping-fast"></i></button></div>
                            </div>
                        </div>
                    </div><!-- End Product Details -->
                </div>
            </div>
        </div>
    </div>
</div>
<script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
<script>
    $(document).on('click', '.show-product-details', function(e) {
        e.preventDefault();
        let productId = $(this).data('id');
        let url = "{{ route('get-product-details', ':id') }}";
        url = url.replace(':id', productId);
        $.ajax({
            url: url,
            type: "GET",
            dataType: "json",
            success: function(response) {
                if (response.status === 'success') {
                    $('#brand-name').text(response.data.brand?.brands ?? 'No Brand');
                    $('.products-title h1').text(response.data.product_title);
                    let productPrice = parseFloat(response.data.product_price || 0);
                    let comparePrice = parseFloat(response.data.compare_price || 0);
                    let price = productPrice.toFixed(2).split('.');
                    let compare = comparePrice.toFixed(2).split('.');
                    $('.product-price').html(
                        `<del class="text-muted fs-6">₹${compare[0]}.<small>${compare[1]}</small></del><span class="text-primary"> ₹${price[0]}.<small>${price[1]}</small></span>`
                    );
                    if (response.data.first_product_image && response.data.first_product_image
                        .image_path) {

                        let imageUrl =
                            '/backend/upload/image/product/' +
                            response.data.product_slug + '/' +
                            response.data.first_product_image.image_path;

                        $('.product-galleryies img')
                            .attr('src', imageUrl)
                            .attr('alt', response.data.product_title ?? '')
                            .on('error', function() {
                                $(this).attr('src', '/backend/upload/image/no-image.png');
                            });
                    }
                }
            },
            error: function(xhr) {
                console.log("Error:", xhr.responseText);
                alert("Something went wrong!");
            }
        });
    });
</script>
