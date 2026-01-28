@extends('frontend.layout.main')
@section('title', 'Cart')
@section('content')
    <div class="py-3 bg-gray-100">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-lg-6 my-2">
                    <h1 class="m-0 h4 text-center text-lg-start">Product Cart</h1>
                </div>
                <div class="col-lg-6 my-2">
                    <ol class="breadcrumb dark-link m-0 small justify-content-center justify-content-lg-end">
                        <li class="breadcrumb-item">
                            <a class="text-nowrap" href="{{ route('home-page') }}"><i class="bi bi-home"></i>Home</a>
                        </li>
                        <li class="breadcrumb-item text-nowrap active" aria-current="page">
                            Product Cart
                        </li>
                    </ol>
                </div>
            </div>
        </div>
    </div>
    <section class="section">
        <div class="container">
            <div class="row gy-4"><!-- Cart Items -->
                <div class="col-lg-8">
                    <div class="d-flex justify-content-between align-items-center pb-4 border-bottom mb-4">
                        <h2 class="h5 mb-0">Products</h2><a href="{{ route('home-page') }}"
                            class="btn btn-outline-primary btn-sm ps-2" href="shop-grid-ls.html"><i
                                class="ci-arrow-left me-2"></i>Continue Shopping</a>
                    </div>
                    @foreach ($cart as $items)
                        @php
                            $product = $products->where('id', $items->product_id)->first();
                        @endphp
                        <div class="d-flex align-items-center flex-row w-100 pb-3 mb-3 border-bottom"><a
                                class="d-inline-block flex-shrink-0 me-3" href="#"><img
                                    src="{{ $product->firstProductImage
                                        ? asset('backend/upload/image/product/' . $product->product_slug . '/' . $product->firstProductImage->image_path)
                                        : asset('backend/assets/images/default_image.jpg') }}"
                                    width="120" alt="Product"></a>
                            <div class="d-flex flex-column flex-sm-row col">
                                <div class="pe-sm-2">
                                    <h3 class="product-title fs-5 mb-1"><a class="text-reset"
                                            href="#">{{ $product->product_title }}</a></h3>
                                    <div class="small"><span class="text-muted me-2">Size:</span>XL</div>
                                    <div class="small"><span class="text-muted me-2">Color:</span>White &amp; Blue
                                    </div>
                                    <div class="lead pt-1 product_price" data-price="{{ $product->product_price }}"></div>
                                </div>
                                <div class="pt-2 pt-sm-0 d-flex d-sm-block ms-sm-auto"><label
                                        class="form-label d-none d-sm-inline-block">Quantity</label>
                                    <div class="cart-qty-01">
                                        <div class="inc qty-btn"><i class="bi bi-caret-up-fill"></i></div>
                                        <input type="hidden" class="cart_id" name="cart_id" id="cart_id"
                                            value="{{ $items->id }}">
                                        <input class="cart-qty-input form-control qtybutton" type="text"
                                            value="{{ $items->quantity }}">
                                        <div class="dec qty-btn"><i class="bi bi-caret-down-fill"></i></div>
                                    </div>
                                    <a href="{{ route('delete-cart-product', $items->id) }}"
                                        class="btn btn-link px-0 text-danger ms-auto">
                                        <i class="bi-trash3 me-2"></i> Remove
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    <button class="btn btn-primary d-block w-100 mt-4" id="update-qty" type="button"><i
                            class="bi-arrow-repeat fs-base me-2"></i>Update cart</button>
                </div><!-- Cart Sidebar -->
                <div class="col-lg-4 ps-xl-7"><!-- Shipping estimates -->
                    <div class="card mb-4">
                        <div class="card-header bg-transparent py-3">
                            <h6 class="m-0 h5">Shipping estimates</h6>
                        </div>
                        <div class="card-body">
                            <div class="mb-3"><select class="form-select" required="">
                                    <option value="">Choose your country</option>
                                    <option value="Australia">Australia</option>
                                    <option value="Belgium">Belgium</option>
                                    <option value="Canada">Canada</option>
                                    <option value="Finland">Finland</option>
                                    <option value="Mexico">Mexico</option>
                                    <option value="New Zealand">New Zealand</option>
                                    <option value="Switzerland">Switzerland</option>
                                    <option value="United States">United States</option>
                                </select>
                                <div class="invalid-feedback">Please choose your country!</div>
                            </div>
                            <div class="mb-3"><select class="form-select" required="">
                                    <option value="">Choose your city</option>
                                    <option value="Bern">Bern</option>
                                    <option value="Brussels">Brussels</option>
                                    <option value="Canberra">Canberra</option>
                                    <option value="Helsinki">Helsinki</option>
                                    <option value="Mexico City">Mexico City</option>
                                    <option value="Ottawa">Ottawa</option>
                                    <option value="Washington D.C.">Washington D.C.</option>
                                    <option value="Wellington">Wellington</option>
                                </select>
                                <div class="invalid-feedback">Please choose your city!</div>
                            </div>
                            <div class="mb-3"><input class="form-control" type="text" placeholder="ZIP / Postal code"
                                    required="">
                                <div class="invalid-feedback">Please provide a valid zip!</div>
                            </div><button class="btn btn-outline-primary d-block w-100" type="submit">Calculate
                                shipping</button>
                        </div>
                    </div><!-- Order Total -->
                    <div class="card">
                        <div class="card-header bg-transparent py-3">
                            <h6 class="m-0 h5">Order Total</h6>
                        </div>
                        <div class="card-body">
                            <ul class="list-unstyled">
                                <li class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="me-2 text-body">Subtotal</h6><span class="text-end" id="cart_subtotal">₹
                                        0.00</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="me-2 text-body">GST 18%</h6><span class="text-end" id="cart_gst">₹
                                        0.00</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center mb-2">
                                    <h6 class="me-2 text-body">Discount</h6><span class="text-end" id="discount">₹
                                        0.00</span>
                                </li>
                                <li class="d-flex justify-content-between align-items-center border-top pt-3 mt-3">
                                    <h6 class="me-2">Grand Total</h6><span class="text-end text-mode"
                                        id="cart_grand_total">₹ 0.00</span>
                                </li>
                            </ul>
                            <div class="pt-2 pb-4">
                                <div class="d-flex">
                                    <input type="text" name="promo_code" id="promo_code"
                                        placeholder="Apply promo code" class="form-control form-control-sm">
                                    <button type="button" id="discount_apply"
                                        class="btn btn-dark btn-sm ms-2">Apply</button>
                                </div>
                                <span class="small" id="promo_code_message"></span>
                            </div>
                            <div class="d-grid gap-2 mx-auto"><a class="btn btn-primary" href="checkout-shipping.html"><i
                                        class="bi-credit-card-2-back me-2"></i>
                                    Proceed to Checkout</a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>
    <script>
        $(document).ready(function() {

            $(document).on('click', '.inc', function() {
                let input = $(this).siblings('.qtybutton');
                let value = parseInt(input.val()) || 1;
                input.val(value + 1).trigger('change');
            });

            $(document).on('click', '.dec', function() {
                let input = $(this).siblings('.qtybutton');
                let value = parseInt(input.val()) || 1;

                if (value > 1) {
                    input.val(value - 1).trigger('change');
                }
            });

            function updatePrice(wrapper) {
                let product_price = parseFloat(wrapper.find('.product_price').data('price'));
                let quantity = parseInt(wrapper.find('.qtybutton').val()) || 1;

                let final_amount = product_price * quantity;

                wrapper.find('.product_price').text(
                    '₹ ' + final_amount.toLocaleString('en-IN', {
                        minimumFractionDigits: 2,
                        maximumFractionDigits: 2
                    })
                );

                updateTotalSum();
            }

            function updateTotalSum() {
                let subtotal = 0;

                $('.product_price').each(function() {
                    let price = $(this).data('price');
                    let qty = $(this).closest('.d-flex.align-items-center')
                        .find('.qtybutton').val();

                    subtotal += price * qty;
                });

                let gst = subtotal * 0.18; // 18% GST
                let grandTotal = subtotal + gst;

                $('#cart_subtotal').text('₹ ' + subtotal.toLocaleString('en-IN', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }));

                $('#cart_gst').text('₹ ' + gst.toLocaleString('en-IN', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }));

                $('#cart_grand_total').text('₹ ' + grandTotal.toLocaleString('en-IN', {
                    minimumFractionDigits: 2,
                    maximumFractionDigits: 2
                }));
            }

            $('.d-flex.align-items-center').each(function() {
                updatePrice($(this));
            });

            $(document).on('keyup change', '.qtybutton', function() {
                let wrapper = $(this).closest('.d-flex.align-items-center');
                updatePrice(wrapper);
            });

            $('#discount_apply').on('click', function() {
                let promo_code = $('#promo_code').val();
                $.ajax({
                    url: "{{ route('check-code') }}",
                    method: "POST",
                    dataType: "json",
                    data: {
                        _token: "{{ csrf_token() }}",
                        code: promo_code
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#promo_code_message').text(response.message).removeClass(
                                'text-danger').addClass('text-success');
                                if(response.discount.type == 'percent'){

                                }else{

                                }
                        } else {
                            $('#promo_code_message').text(response.message).removeClass(
                                'text-success').addClass('text-danger');
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                        alert("Something went wrong!")
                    }
                })
            });
        });
    </script>
    <script>
        $(document).on('click', '#update-qty', function(e) {
            e.preventDefault();
            let cartData = [];
            $('.cart-qty-01').each(function() {
                cartData.push({
                    cart_id: $(this).find('.cart_id').val(),
                    quantity: $(this).find('.qtybutton').val()
                });
            });
            $.ajax({
                url: "{{ route('update-cart') }}",
                type: "POST",
                data: {
                    _token: "{{ csrf_token() }}",
                    cart: cartData
                },
                success: function(response) {
                    location.reload();
                }
            });
        });
    </script>
@endsection
