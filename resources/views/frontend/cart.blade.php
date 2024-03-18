@extends('frontend.layouts.master')
@section('title', 'Cart')
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2>Cart</h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>
                                <li class="breadcrumb-item active">Cart</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Cart Section Start -->
    <section class="cart-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-sm-5 g-3">
                <div class="col-xxl-9">
                    <div class="cart-table">
                        <div class="table-responsive-xl">
                            @if (auth()->guest() && empty(session()->get('cart')))
                                <h2 style="color: #FF9999; border: 2px solid #FF9999; padding: 10px;">No products in cart.
                                    <a href="{{ route('home') }}">Click here </a>to add products to your cart.
                                </h2>
                            @elseif (auth()->check() && $cart->isEmpty())
                                <h2 style="color: #FF9999; border: 2px solid #FF9999; padding: 10px;">No products in cart.
                                    <a href="{{ route('home') }}">Click here </a>to add products to your cart.
                                </h2>
                            @endif

                            <table class="table">
                                <tbody>
                                    @foreach ($cart as $item)
                                        <tr class="product-box-contain" data-cart-delete="{{ $item->id }}">
                                            <td class="product-detail">
                                                <div class="product border-0">
                                                    <a href="{{ route('productDetails', ['slug' => $item->product->slug]) }}"
                                                        class="product-image">
                                                        <img src="{{ asset($item->product->thumbnail_image_source) }}"
                                                            class="img-fluid blur-up lazyload" alt="img">
                                                    </a>
                                                    <div class="product-detail">
                                                        <ul>
                                                            <li class="name">
                                                                <a
                                                                    href="{{ route('productDetails', ['id' => $item->product->id, 'slug' => $item->product->slug]) }}">{{ $item->product->product_name }}</a>
                                                            </li>

                                                            <li class="text-content"><span class="text-title">Brand
                                                                    :</span>{{ $item->product->brand->name }} </li>
                                                        </ul>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="price">
                                                <h4 class="table-title text-content">Price</h4>
                                                <h5>$35.10 <del class="text-content">$45.68</del></h5>
                                                <h6 class="theme-color">You Save : $20.68</h6>
                                            </td>

                                            <td class="quantity">
                                                <h4 class="table-title text-content">Qty</h4>
                                                <div class="quantity-price">
                                                    <div class="cart_qty">
                                                        <div class="input-group">
                                                            <button type="button" class="btn qty-left-minus"
                                                                data-type="minus" data-field=""
                                                                data-product-id="{{ $item->product_id }}">
                                                                <i class="fa fa-minus ms-0"></i>
                                                            </button>
                                                            <input class="form-control input-number qty-input"
                                                                type="text" name="quantity"
                                                                value="{{ $item->quantity }}">
                                                            <button type="button" class="btn qty-right-plus"
                                                                data-type="plus" data-field=""
                                                                data-product-id="{{ $item->product_id }}">
                                                                <i class="fa fa-plus ms-0"></i>
                                                            </button>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>

                                            <td class="subtotal">
                                                <h4 class="table-title text-content">Total</h4>
                                                <h5>$35.10</h5>
                                            </td>

                                            <td class="save-remove">
                                                <h4 class="table-title text-content">Action</h4>
                                                <a class="remove close_button" href="javascript:void(0)"
                                                    data-cart-id="{{ $item->id }}">Remove</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>

                <div class="col-xxl-3">
                    <div class="summery-box p-sticky">
                        <div class="summery-header">
                            <h3>Cart Total</h3>
                        </div>

                        <div class="summery-contain">
                            <div class="coupon-cart">
                                <h6 class="text-content mb-2">Coupon Apply</h6>
                                <div class="mb-3 coupon-box input-group">
                                    <input type="email" class="form-control" id="exampleFormControlInput1"
                                        placeholder="Enter Coupon Code Here...">
                                    <button class="btn-apply">Apply</button>
                                </div>
                            </div>
                            <ul>
                                <li>
                                    <h4>Subtotal</h4>
                                    <h4 class="price">$125.65</h4>
                                </li>

                                <li>
                                    <h4>Coupon Discount</h4>
                                    <h4 class="price">(-) 0.00</h4>
                                </li>

                                <li class="align-items-start">
                                    <h4>Shipping</h4>
                                    <h4 class="price text-end">$6.90</h4>
                                </li>
                            </ul>
                        </div>

                        <ul class="summery-total">
                            <li class="list-total border-top-0">
                                <h4>Total (USD)</h4>
                                <h4 class="price theme-color">$132.58</h4>
                            </li>
                        </ul>

                        <div class="button-group cart-button">
                            <ul>
                                <li>
                                    <button onclick="location.href = '{{ route('checkout') }}';"
                                        class="btn btn-animation proceed-btn fw-bold">Process To Checkout</button>
                                </li>

                                <li>
                                    <button onclick="location.href = '{{ route('home') }}';"
                                        class="btn btn-light shopping-button text-dark">
                                        <i class="fa-solid fa-arrow-left-long"></i>Return To Shopping</button>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Cart Section End -->
@endsection
@section('scripts')
    <script>
        $('.qty-right-plus').on('click', function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            var input = $(this).siblings('input[name="quantity"]');
            var newValue = parseInt(input.val()) + 1;
            input.val(newValue);
            input.attr('data-button-pressed',
                'plus'); // Set the data attribute to indicate the plus button was pressed
            // Enable the decrement button if the value becomes greater than 0
            input.siblings('.qty-left-minus').prop('disabled', false);
            // make ajax request
            callAddToCart(productId, newValue, 'INC');

        });

        $('.qty-left-minus').on('click', function(e) {
            e.preventDefault();
            var productId = $(this).data('product-id');
            var input = $(this).siblings('input[name="quantity"]');
            var newValue = parseInt(input.val()) - 1;

            if (newValue >= 1) {
                input.val(newValue);
                input.attr('data-button-pressed',
                    'minus'); // Set the data attribute to indicate the minus button was pressed
                // Enable the increment button if the value becomes less than 4
                input.siblings('.qty-right-plus').prop('disabled', false);
                // make ajax request
                callAddToCart(productId, newValue, 'DEC');
            }
            // Disable the decrement button if the value becomes 0
            if (newValue === 1) {
                $(this).prop('disabled', true);
            }
        });

        // remove from cart
        $('.close_button').on('click', function(e) {
            e.preventDefault();
            var cartId = $(this).data('cart-id');

            $.ajax({
                url: '/cart/delete/' + cartId, // URL to send the POST request
                type: 'DELETE',
                success: function(response) {
                    toastr.success(response.message);
                    $('li[data-cart-delete="' + cartId + '"]').remove();
                    var cartCount = $('#cart-count').text();
                    if (cartCount > 0) {
                        $('#cart-count').text(cartCount - 1);
                    }
                },
                error: function(error) {
                    // Handle error response, e.g., show an error message
                    toastr.error(error.responseJSON.message);
                }
            });
        });
    </script>
@endsection
