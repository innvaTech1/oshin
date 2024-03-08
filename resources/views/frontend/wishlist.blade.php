@extends('frontend.layouts.master')
@section('title', 'Wishlist')
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Wishlist</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Wishlist</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Wishlist Section Start -->
    <section class="wishlist-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-3 g-2">
                @foreach ($items as $item)
                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6 product-box-contain">
                        <div class="product-box-3 h-100">
                            <div class="product-header">
                                <div class="product-image" style="padding: 0px;margin-bottom:20px">
                                    <a href="{{ route('productDetails', ['slug' => $item->product->slug]) }}">
                                        <img src="{{ asset($item->product->thumbnail_image_source) }}"
                                            class="img-fluid blur-up lazyload" alt="">
                                    </a>

                                    <div class="product-header-top">
                                        <button class="btn wishlist-button close_button"
                                            data-wishlist-id="{{ $item->id }}">
                                            <i data-feather="x"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                            <div class="product-footer">
                                <div class="product-detail">
                                    <span class="span-name">{{ $item->product->product_name }}</span>
                                    <a href="product-left-thumbnail.html">
                                        <h5 class="name">{{ $item->product->specification }}</h5>
                                    </a>
                                    <h6 class="unit mt-1">{{ $item->product->model_number }}</h6>
                                    <h5 class="price">
                                        <span class="theme-color">$08.02</span>
                                        <del>$15.15</del>
                                    </h5>

                                    <div class="add-to-cart-box bg-white mt-2">
                                        <button class="btn btn-add-cart addcart-button"
                                            data-product-id="{{ $item->product->id }}">Add
                                            <span class="add-icon bg-light-gray">
                                                <i class="fa-solid fa-plus"></i>
                                            </span>
                                        </button>
                                        <div class="cart_qty qty-box @if ($item->product->cart?->quantity) open @endif">
                                            <div class="input-group bg-white">
                                                <button type="button" class="qty-left-minus bg-gray" data-type="minus"
                                                    data-field="" data-product-id="{{ $item->product->id }}">
                                                    <i class="fa fa-minus"></i>
                                                </button>
                                                <input class="form-control input-number qty-input" type="text"
                                                    name="quantity" value="{{ $item->product->cart->quantity ?? 0 }}">
                                                <button type="button" class="qty-right-plus bg-gray" data-type="plus"
                                                    data-field="" data-product-id="{{ $item->product->id }}">
                                                    <i class="fa fa-plus"></i>
                                                </button>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    <!-- Wishlist Section End -->
@endsection

@section('scripts')
    <!-- Quantity Js -->
    <script src="{{ asset('assets/js/quantity-2.js') }}"></script>

    <script>
        $(document).ready(function() {

            // DELETE WISHLIST ITEM
            $('.close_button').on('click', function(e) {
                e.preventDefault();

                // Get the product ID from the data-product-id attribute
                var wishlistId = $(this).data('wishlist-id');

                // Perform an AJAX POST request
                $.ajax({
                    url: `/wishlist/delete/${wishlistId}`, // URL to send the POST request
                    type: 'DELETE',
                    success: function(response) {
                        toastr.success(response.message);
                    },
                    error: function(error) {
                        toastr.error(error.responseJSON.message);
                    }
                });
            });

            // add to cart
            $('.btn-add-cart').on('click', function(e) {
                e.preventDefault();
                // Get the product ID from the data-product-id attribute
                var productId = $(this).data('product-id');
                // Get the quantity from the input field
                var quantity = $('input[name="quantity"]').val();
                // Perform an AJAX POST request
                callAddToCart(productId, quantity, 'ADD');
            });

            // Increase quantity
            $('.qty-right-plus').on('click', function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                var input = $(this).prev('input[name="quantity"]');
                var newValue = parseInt(input.val()) + 1;
                input.val(newValue);
                // Perform an AJAX POST request
                callAddToCart(productId, newValue, 'INC');

            });

            // Decrease quantity
            $('.qty-left-minus').on('click', function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');
                var input = $(this).next('input[name="quantity"]');
                var newValue = parseInt(input.val()) - 1;
                if (newValue >= 0) {
                    input.val(newValue);
                    // Perform an AJAX POST request
                    callAddToCart(productId, newValue, 'DEC');
                }
            });
        });
    </script>
@endsection
