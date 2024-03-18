@extends('frontend.layouts.master')
@section('title', 'Compare')
@section('content')
    <!-- Breadcrumb Section Start -->
    {{-- <section class="breadcrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-contain">
                    <h2 class="mb-2">Compare</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="index.html">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item">Shop</li>
                            <li class="breadcrumb-item active">Compare</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section> --}}
    <!-- Breadcrumb Section End -->

    <!-- Compare Section Start -->
    <section class="compare-section section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="table-responsive">
                        <table class="table compare-table">
                            <tbody>
                                <tr>
                                    <th>Product</th>
                                    @foreach ($products as $product)
                                        <td class="product_row_{{ $product->id }}">
                                            <a class="text-title" href="{{ route('productDetails', $product->slug) }}">
                                                {{ $product->product_name }}
                                            </a>
                                        </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>Images</th>
                                    @foreach ($products as $product)
                                        <td class="product_row_{{ $product->id }}">
                                            <a href="{{ route('productDetails', $product->slug) }}" class="compare-image">
                                                <img src="{{ asset($product->thumbnail_image_source) }}"
                                                    class="img-fluid blur-up lazyload" alt="{{ $product->slug }}">
                                            </a>
                                        </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>Brand</th>
                                    @foreach ($products as $product)
                                        <td class="product_row_{{ $product->id }}">
                                            {{ $product->brand->name }}
                                        </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>Description</th>
                                    @foreach ($products as $product)
                                        <td class="product_row_{{ $product->id }}">
                                            {{ $product->description }}
                                        </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>Specification</th>
                                    @foreach ($products as $product)
                                        <td class="product_row_{{ $product->id }}">
                                            {{ $product->specification }}
                                        </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>Price</th>
                                    @foreach ($products as $product)
                                        <td class="price text-content product_row_{{ $product->id }}">
                                            $ {{ $product->max_sell_price }}
                                        </td>
                                    @endforeach
                                </tr>


                                <tr>
                                    <th>Rating</th>
                                    @foreach ($products as $product)
                                        <td class="product_row_{{ $product->id }}">
                                            <div class="compare-rating">
                                                <ul class="rating">
                                                    @for ($i = 1; $i <= 5; $i++)
                                                        @if ($i <= $product->avg_rating)
                                                            <li><i data-feather="star" class="fill"></i></li>
                                                        @else
                                                            <li><i data-feather="star"></i></li>
                                                        @endif
                                                    @endfor
                                                </ul>
                                                {{-- <span class="text-content">(20 Raring)</span> --}}
                                            </div>
                                        </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>Purchase</th>
                                    @foreach ($products as $product)
                                        <td class="product_row_{{ $product->id }}">
                                            <button data-product-id='{{ $product->id }}'
                                                class="btn btn-animation btn-sm w-100 compare-btn-add-cart"
                                                @if (
                                                    (!empty($product->cart) && isset($product->cart[0])) ||
                                                        (session()->has('cart') && isset(session('cart')[$product->id]))) disabled @endif>
                                                @if (
                                                    (!empty($product->cart) && isset($product->cart[0])) ||
                                                        (session()->has('cart') && isset(session('cart')[$product->id])))
                                                    Already in cart
                                                @else
                                                    Add to cart
                                                @endif
                                            </button>
                                        </td>
                                    @endforeach
                                </tr>

                                <tr>
                                    <th>Remore from compare</th>
                                    @foreach ($products as $product)
                                        <td class="product_row_{{ $product->id }}">
                                            <a data-product-id='{{ $product->id }}' href="javascript:void(0)"
                                                class="text-content remove_column"><i
                                                    class="fa-solid fa-trash-can me-2"></i> Remove</a>
                                        </td>
                                    @endforeach
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Compare Section End -->
@endsection
@section('scripts')
    <script>
        $(document).ready(function() {
            $('.remove_column').click(function(e) {
                e.preventDefault();
                var productId = $(this).data('product-id');

                $.ajax({
                    url: '/compare/delete/' + productId,
                    method: 'DELETE',
                    success: function(response) {
                        toastr.success(response.message);
                        setTimeout(() => {
                            $('.product_row_' + productId).remove();
                        }, 100);
                    },
                    error: function(error) {
                        console.error(error.responseText);
                    }
                });
            });

            // add product to cart
            $('.compare-btn-add-cart').on('click', function() {
                var productId = $(this).data('product-id');
                callAddToCart(productId, 1, 'ADD');
            });
        });
    </script>
@endsection
