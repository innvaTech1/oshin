@extends('frontend.layouts.master')
@section('title', 'Product Details Page')
@section('content')
    <!-- Breadcrumb Section Start -->
    <section class="breadcrumb-section pt-0">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="breadcrumb-contain">
                        <h2> {{ $product->product_name }} </h2>
                        <nav>
                            <ol class="breadcrumb mb-0">
                                <li class="breadcrumb-item">
                                    <a href="index.html">
                                        <i class="fa-solid fa-house"></i>
                                    </a>
                                </li>

                                <li class="breadcrumb-item active">{{ $product->product_name }}</li>
                            </ol>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Breadcrumb Section End -->

    <!-- Product Left Sidebar Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-xxl-9 col-xl-8 col-lg-7 wow fadeInUp">
                    <div class="row g-4">
                        <div class="col-xl-6 wow fadeInUp">
                            <div class="product-left-box">
                                <div class="row g-2">
                                    <div class="col-xxl-10 col-lg-12 col-md-10 order-xxl-2 order-lg-1 order-md-2">
                                        <div class="product-main-2 no-arrow">
                                            <div>
                                                <div class="slider-image">
                                                    <img src="{{ asset($product->thumbnail_image_source) }}" id="img-1"
                                                        data-zoom-image="{{ asset($product->thumbnail_image_source) }}"
                                                        class="img-fluid image_zoom_cls-0 blur-up lazyload" alt="img"
                                                        style="width: 100%; object-fit: cover">
                                                </div>
                                            </div>

                                            @foreach ($product->images as $image)
                                                <div>
                                                    <div class="slider-image">
                                                        <img src="{{ asset($image->images_source) }}"
                                                            data-zoom-image="{{ asset($image->images_source) }}"
                                                            class="img-fluid image_zoom_cls-1 blur-up lazyload"
                                                            alt="img" style="width: 100%; object-fit: cover">
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>

                                    <div class="col-xxl-2 col-lg-12 col-md-2 order-xxl-1 order-lg-2 order-md-1">
                                        <div class="left-slider-image-2 left-slider no-arrow slick-top">
                                            <div>
                                                <div class="sidebar-image">
                                                    <img src="{{ asset($product->thumbnail_image_source) }}"
                                                        class="img-fluid blur-up lazyload" alt="img">
                                                </div>
                                            </div>
                                            @foreach ($product->images as $image)
                                                <div>
                                                    <div class="sidebar-image">
                                                        <img src="{{ asset($image->images_source) }}"
                                                            class="img-fluid blur-up lazyload" alt="img">
                                                    </div>
                                                </div>
                                            @endforeach

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-6 wow fadeInUp" data-wow-delay="0.1s">
                            <div class="right-box-contain">
                                @if ($product->discount_type == 'percentage')
                                    <h6 class="offer-top">{{ $product->discount }}%</h6>
                                @endif
                                <h2 class="name">{{ $product->product_name }} </h2>
                                <div class="price-rating">
                                    <h3 class="theme-color price">${{ $product->min_sell_price }} <del
                                            class="text-content">${{ $product->max_sell_price }}</del>
                                        {{-- <span class="offer theme-color">(8% off)</span> --}}
                                    </h3>
                                    <div class="product-rating custom-rate">
                                        <ul class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $product->avg_rating)
                                                    <li><i data-feather="star" class="fill"></i></li>
                                                @else
                                                    <li><i data-feather="star"></i></li>
                                                @endif
                                            @endfor
                                        </ul>
                                        <span class="review">23 Customer Review</span>
                                    </div>
                                </div>

                                <div class="product-contain">
                                    <p>
                                        {{ $product->meta_description }}
                                    </p>
                                </div>

                                <div class="product-package">
                                    <div class="product-title">
                                        <h4>Colors</h4>
                                    </div>
                                    <ul class="select-package">
                                        <li>
                                            <a href="javascript:void(0)">Red Roses</a>
                                        </li>
                                        <li>
                                            <a href="javascript:void(0)">With Pink Roses</a>
                                        </li>
                                    </ul>
                                </div>

                                <div class="time deal-timer product-deal-timer mx-md-0 mx-auto" id="clockdiv-1"
                                    data-hours="1" data-minutes="2" data-seconds="3">
                                    <div class="product-title">
                                        <h4>Hurry up! Sales Ends In</h4>
                                    </div>
                                    <ul>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="days d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Days</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="hours d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Hours</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="minutes d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Min</h6>
                                            </div>
                                        </li>
                                        <li>
                                            <div class="counter d-block">
                                                <div class="seconds d-block">
                                                    <h5></h5>
                                                </div>
                                                <h6>Sec</h6>
                                            </div>
                                        </li>
                                    </ul>
                                </div>

                                @if (!$in_cart)
                                    <form action="{{ route('cart.add') }}" method="POST">
                                        @csrf
                                        <div class="note-box product-package">
                                            <div class="cart_qty qty-box product-qty">
                                                <div class="input-group">
                                                    <button type="button" class="qty-right-plus" data-type="plus"
                                                        data-field="">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                    <input type="hidden" name="product_id" value="{{ $product->id }}">
                                                    <input type="hidden" name="page" value="product_page">
                                                    <input class="form-control input-number qty-input" type="text"
                                                        name="quantity" value="1">
                                                    <button type="button" class="qty-left-minus" data-type="minus"
                                                        data-field="">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                </div>
                                            </div>

                                            <button class="btn btn-md bg-dark cart-button text-white w-100">Add To
                                                Cart</button>
                                    </form>
                            </div>
                        @else
                            <div class="note-box product-package">
                                <button onclick="window.location.href = '{{ route('cart.index') }}'"
                                    class="btn btn-md bg-dark cart-button text-white w-100">Already In Cart</button>
                            </div>
                            @endif

                            <div class="progress-sec">
                                <div class="left-progressbar">
                                    <h6>Please hurry! Only 5 left in stock</h6>
                                    <div role="progressbar" class="progress warning-progress">
                                        <div class="progress-bar progress-bar-striped progress-bar-animated"
                                            style="width: 50%;"></div>
                                    </div>
                                </div>
                            </div>

                            <div class="buy-box">
                                <a href="#" id="add-to-wishlist" data-product-id="{{ $product->id }}">
                                    <i data-feather="heart" id="heart-icon"
                                        @if ($is_wishlisted) style="color: red; fill: red;" @endif></i>
                                    <span>Wishlist</span>
                                </a>
                                <a href="compare.html">
                                    <i data-feather="shuffle"></i>
                                    <span>Add To Compare</span>
                                </a>
                            </div>

                            <div class="pickup-box">
                                <div class="product-title">
                                    <h4>Store Information</h4>
                                </div>

                                <div class="pickup-detail">
                                    <h4 class="text-content">Lollipop cake chocolate chocolate cake dessert
                                        jujubes.
                                        Shortbread sugar plum dessert powder cookie sweet brownie.</h4>
                                </div>

                                <div class="product-info">
                                    <ul class="product-info-list product-info-list-2">
                                        <li>Type : <a href="javascript:void(0)">Black Forest</a></li>
                                        <li>SKU : <a href="javascript:void(0)">SDFVW65467</a></li>
                                        <li>MFG : <a href="javascript:void(0)">Jun 4, 2022</a></li>
                                        <li>Stock : <a href="javascript:void(0)">2 Items Left</a></li>
                                        <li>Tags : <a href="javascript:void(0)">Cake,</a> <a
                                                href="javascript:void(0)">Backery</a></li>
                                    </ul>
                                </div>
                            </div>

                            <div class="payment-option">
                                <div class="product-title">
                                    <h4>Guaranteed Safe Checkout</h4>
                                </div>
                                <ul>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <img src="../assets/images/product/payment/1.svg" class="blur-up lazyload"
                                                alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <img src="../assets/images/product/payment/2.svg" class="blur-up lazyload"
                                                alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <img src="../assets/images/product/payment/3.svg" class="blur-up lazyload"
                                                alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <img src="../assets/images/product/payment/4.svg" class="blur-up lazyload"
                                                alt="">
                                        </a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">
                                            <img src="../assets/images/product/payment/5.svg" class="blur-up lazyload"
                                                alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-12">
                        <div class="product-section-box">
                            <ul class="nav nav-tabs custom-nav" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <button class="nav-link active" id="description-tab" data-bs-toggle="tab"
                                        data-bs-target="#description" type="button" role="tab">Description</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="info-tab" data-bs-toggle="tab" data-bs-target="#info"
                                        type="button" role="tab">Additional info</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="care-tab" data-bs-toggle="tab" data-bs-target="#care"
                                        type="button" role="tab">Care
                                        Instructions</button>
                                </li>

                                <li class="nav-item" role="presentation">
                                    <button class="nav-link" id="review-tab" data-bs-toggle="tab"
                                        data-bs-target="#review" type="button" role="tab">Review</button>
                                </li>
                            </ul>

                            <div class="tab-content custom-tab" id="myTabContent">
                                <div class="tab-pane fade show active" id="description" role="tabpanel">
                                    <div class="product-description">
                                        <div class="nav-desh">
                                            <p>{{ $product->description }}</p>
                                        </div>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="info" role="tabpanel">
                                    <div class="table-responsive">
                                        <table class="table info-table">
                                            <tbody>
                                                <tr>
                                                    <td>Type</td>
                                                    <td>{{ $product->product_type == 1 ? 'Single Product' : 'Variant Product' }}
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td>Category</td>
                                                    <td>NEED TO WORK</td>
                                                </tr>
                                                <tr>
                                                    <td>Brand</td>
                                                    <td>{{ $product->brand->name }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Model</td>
                                                    <td>{{ $product->model_number }}</td>
                                                </tr>
                                                <tr>
                                                    <td>Shipping Type</td>
                                                    <td>
                                                        {{ $product->shipping_type == 1 ? 'Free Shipping' : 'Flat Shipping' }}
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="care" role="tabpanel">
                                    <div class="information-box">
                                        <ul>
                                            <li>Store cream cakes in a refrigerator. Fondant cakes should be
                                                stored in an air conditioned environment.</li>

                                            <li>Slice and serve the cake at room temperature and make sure
                                                it is not exposed to heat.</li>

                                            <li>Use a serrated knife to cut a fondant cake.</li>

                                            <li>Sculptural elements and figurines may contain wire supports
                                                or toothpicks or wooden skewers for support.</li>

                                            <li>Please check the placement of these items before serving to
                                                small children.</li>

                                            <li>The cake should be consumed within 24 hours.</li>

                                            <li>Enjoy your cake!</li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="tab-pane fade" id="review" role="tabpanel">
                                    <div class="review-box">
                                        <div class="row">
                                            <div class="col-xl-5">
                                                <div class="product-rating-box">
                                                    <div class="row">
                                                        <div class="col-xl-12">
                                                            <div class="product-main-rating">
                                                                <h2>3.40
                                                                    <i data-feather="star"></i>
                                                                </h2>

                                                                <h5>5 Overall Rating</h5>
                                                            </div>
                                                        </div>

                                                        <div class="col-xl-12">
                                                            <ul class="product-rating-list">
                                                                <li>
                                                                    <div class="rating-product">
                                                                        <h5>5<i data-feather="star"></i></h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" style="width: 40%;">
                                                                            </div>
                                                                        </div>
                                                                        <h5 class="total">2</h5>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="rating-product">
                                                                        <h5>4<i data-feather="star"></i></h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" style="width: 20%;">
                                                                            </div>
                                                                        </div>
                                                                        <h5 class="total">1</h5>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="rating-product">
                                                                        <h5>3<i data-feather="star"></i></h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" style="width: 0%;">
                                                                            </div>
                                                                        </div>
                                                                        <h5 class="total">0</h5>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="rating-product">
                                                                        <h5>2<i data-feather="star"></i></h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" style="width: 20%;">
                                                                            </div>
                                                                        </div>
                                                                        <h5 class="total">1</h5>
                                                                    </div>
                                                                </li>
                                                                <li>
                                                                    <div class="rating-product">
                                                                        <h5>1<i data-feather="star"></i></h5>
                                                                        <div class="progress">
                                                                            <div class="progress-bar" style="width: 20%;">
                                                                            </div>
                                                                        </div>
                                                                        <h5 class="total">1</h5>
                                                                    </div>
                                                                </li>

                                                            </ul>

                                                            <div class="review-title-2">
                                                                <h4 class="fw-bold">Review this product</h4>
                                                                <p>Let other customers know what you think</p>
                                                                <button class="btn" type="button"
                                                                    data-bs-toggle="modal"
                                                                    data-bs-target="#writereview">Write a
                                                                    review</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="col-xl-7">
                                                <div class="review-people">
                                                    <ul class="review-list">
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image people-text">
                                                                        <img alt="user" class="img-fluid "
                                                                            src="../assets/images/review/1.jpg">
                                                                    </div>
                                                                </div>
                                                                <div class="people-comment">
                                                                    <div class="people-name"><a href="javascript:void(0)"
                                                                            class="name">Jack Doe</a>
                                                                        <div class="date-time">
                                                                            <h6 class="text-content"> 29 Sep
                                                                                2023
                                                                                06:40:PM
                                                                            </h6>
                                                                            <div class="product-rating">
                                                                                <ul class="rating">
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"></i>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reply">
                                                                        <p>Avoid this product. The quality is
                                                                            terrible, and
                                                                            it started falling apart almost
                                                                            immediately. I
                                                                            wish I had read more reviews before
                                                                            buying.
                                                                            Lesson learned.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image people-text">
                                                                        <img alt="user" class="img-fluid "
                                                                            src="../assets/images/review/2.jpg">
                                                                    </div>
                                                                </div>
                                                                <div class="people-comment">
                                                                    <div class="people-name"><a href="javascript:void(0)"
                                                                            class="name">Jessica
                                                                            Miller</a>
                                                                        <div class="date-time">
                                                                            <h6 class="text-content"> 29 Sep
                                                                                2023
                                                                                06:34:PM
                                                                            </h6>
                                                                            <div class="product-rating">
                                                                                <div class="product-rating">
                                                                                    <ul class="rating">
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"
                                                                                                class="fill"></i>
                                                                                        </li>
                                                                                        <li>
                                                                                            <i data-feather="star"></i>
                                                                                        </li>
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reply">
                                                                        <p>Honestly, I regret buying this item.
                                                                            The
                                                                            quality
                                                                            is subpar, and it feels like a waste
                                                                            of
                                                                            money. I
                                                                            wouldn't recommend it to anyone.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image people-text">
                                                                        <img alt="user" class="img-fluid "
                                                                            src="../assets/images/review/3.jpg">
                                                                    </div>
                                                                </div>
                                                                <div class="people-comment">
                                                                    <div class="people-name"><a href="javascript:void(0)"
                                                                            class="name">Rome Doe</a>
                                                                        <div class="date-time">
                                                                            <h6 class="text-content"> 29 Sep
                                                                                2023
                                                                                06:18:PM
                                                                            </h6>
                                                                            <div class="product-rating">
                                                                                <ul class="rating">
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"></i>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reply">
                                                                        <p>I am extremely satisfied with this
                                                                            purchase. The
                                                                            item arrived promptly, and the
                                                                            quality
                                                                            is
                                                                            exceptional. It's evident that the
                                                                            makers paid
                                                                            attention to detail. Overall, a
                                                                            fantastic buy!
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image people-text">
                                                                        <img alt="user" class="img-fluid "
                                                                            src="../assets/images/review/4.jpg">
                                                                    </div>
                                                                </div>
                                                                <div class="people-comment">
                                                                    <div class="people-name"><a href="javascript:void(0)"
                                                                            class="name">Sarah
                                                                            Davis</a>
                                                                        <div class="date-time">
                                                                            <h6 class="text-content"> 29 Sep
                                                                                2023
                                                                                05:58:PM
                                                                            </h6>
                                                                            <div class="product-rating">
                                                                                <ul class="rating">
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"></i>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reply">
                                                                        <p>I am genuinely delighted with this
                                                                            item.
                                                                            It's a
                                                                            total winner! The quality is superb,
                                                                            and
                                                                            it has
                                                                            added so much convenience to my
                                                                            daily
                                                                            routine.
                                                                            Highly satisfied customer!</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                        <li>
                                                            <div class="people-box">
                                                                <div>
                                                                    <div class="people-image people-text">
                                                                        <img alt="user" class="img-fluid "
                                                                            src="../assets/images/review/5.jpg">
                                                                    </div>
                                                                </div>
                                                                <div class="people-comment">
                                                                    <div class="people-name"><a href="javascript:void(0)"
                                                                            class="name">John Doe</a>
                                                                        <div class="date-time">
                                                                            <h6 class="text-content"> 29 Sep
                                                                                2023
                                                                                05:22:PM
                                                                            </h6>
                                                                            <div class="product-rating">
                                                                                <ul class="rating">
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"
                                                                                            class="fill"></i>
                                                                                    </li>
                                                                                    <li>
                                                                                        <i data-feather="star"></i>
                                                                                    </li>
                                                                                </ul>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                    <div class="reply">
                                                                        <p>Very impressed with this purchase.
                                                                            The
                                                                            item is of
                                                                            excellent quality, and it has
                                                                            exceeded
                                                                            my
                                                                            expectations.</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xxl-3 col-xl-4 col-lg-5 d-none d-lg-block wow fadeInUp">
                <div class="right-sidebar-box">
                    <div class="vendor-box">
                        <div class="vendor-contain">
                            <div class="vendor-image">
                                <img src="../assets/images/product/vendor.png" class="blur-up lazyload" alt="">
                            </div>

                            <div class="vendor-name">
                                <h5 class="fw-500">Noodles Co.</h5>

                                <div class="product-rating mt-1">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star"></i>
                                        </li>
                                    </ul>
                                    <span>(36 Reviews)</span>
                                </div>

                            </div>
                        </div>

                        <p class="vendor-detail">Noodles & Company is an American fast-casual
                            restaurant that offers international and American noodle dishes and pasta.</p>

                        <div class="vendor-list">
                            <ul>
                                <li>
                                    <div class="address-contact">
                                        <i data-feather="map-pin"></i>
                                        <h5>Address: <span class="text-content">1288 Franklin Avenue</span>
                                        </h5>
                                    </div>
                                </li>

                                <li>
                                    <div class="address-contact">
                                        <i data-feather="headphones"></i>
                                        <h5>Contact Seller: <span class="text-content">(+1)-123-456-789</span>
                                        </h5>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>

                    <!-- Trending Product -->
                    {{-- <div class="pt-25">
                            <div class="category-menu">
                                <h3>Trending Products</h3>

                                <ul class="product-list product-right-sidebar border-0 p-0">
                                    <li>
                                        <div class="offer-product">
                                            <a href="product-left-thumbnail.html" class="offer-image">
                                                <img src="../assets/images/vegetable/product/23.png"
                                                    class="img-fluid blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="product-left-thumbnail.html">
                                                        <h6 class="name">Meatigo Premium Goat Curry</h6>
                                                    </a>
                                                    <span>450 G</span>
                                                    <h6 class="price theme-color">$ 70.00</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="offer-product">
                                            <a href="product-left-thumbnail.html" class="offer-image">
                                                <img src="../assets/images/vegetable/product/24.png"
                                                    class="blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="product-left-thumbnail.html">
                                                        <h6 class="name">Dates Medjoul Premium Imported</h6>
                                                    </a>
                                                    <span>450 G</span>
                                                    <h6 class="price theme-color">$ 40.00</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li>
                                        <div class="offer-product">
                                            <a href="product-left-thumbnail.html" class="offer-image">
                                                <img src="../assets/images/vegetable/product/25.png"
                                                    class="blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="product-left-thumbnail.html">
                                                        <h6 class="name">Good Life Walnut Kernels</h6>
                                                    </a>
                                                    <span>200 G</span>
                                                    <h6 class="price theme-color">$ 52.00</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>

                                    <li class="mb-0">
                                        <div class="offer-product">
                                            <a href="product-left-thumbnail.html" class="offer-image">
                                                <img src="../assets/images/vegetable/product/26.png"
                                                    class="blur-up lazyload" alt="">
                                            </a>

                                            <div class="offer-detail">
                                                <div>
                                                    <a href="product-left-thumbnail.html">
                                                        <h6 class="name">Apple Red Premium Imported</h6>
                                                    </a>
                                                    <span>1 KG</span>
                                                    <h6 class="price theme-color">$ 80.00</h6>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div> --}}

                    <!-- Banner Section -->
                    <div class="ratio_156 pt-25">
                        <div class="home-contain">
                            <img src="../assets/images/vegetable/banner/8.jpg" class="bg-img blur-up lazyload"
                                alt="">
                            <div class="home-detail p-top-left home-p-medium">
                                <div>
                                    <h6 class="text-yellow home-banner">Seafood</h6>
                                    <h3 class="text-uppercase fw-normal"><span class="theme-color fw-bold">Freshes</span>
                                        Products</h3>
                                    <h3 class="fw-light">every hour</h3>
                                    <button onclick="location.href = 'shop-left-sidebar.html';"
                                        class="btn btn-animation btn-md fw-bold mend-auto">Shop Now <i
                                            class="fa-solid fa-arrow-right icon"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
    </section>
    <!-- Product Left Sidebar End -->

    <!-- Related Product Section Start -->
    {{-- <section class="product-list-section section-b-space">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Related Products</h2>
                <span class="title-leaf">
                    <svg class="icon-width">
                        <use xlink:SOMETHING WAS HERE"></use>
                    </svg>
                </span>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="slider-6_1 product-wrapper">
                        <div>
                            <div class="product-box-3 wow fadeInUp">
                                <div class="product-header">
                                    <div class="product-image">
                                        <a href="product-left.htm">
                                            <img src="../assets/images/cake/product/11.png"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>

                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#view">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                <a href="compare.html">
                                                    <i data-feather="refresh-cw"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <i data-feather="heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="product-footer">
                                    <div class="product-detail">
                                        <span class="span-name">Cake</span>
                                        <a href="product-left-thumbnail.html">
                                            <h5 class="name">Chocolate Chip Cookies 250 g</h5>
                                        </a>
                                        <div class="product-rating mt-2">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                            </ul>
                                            <span>(5.0)</span>
                                        </div>
                                        <h6 class="unit">500 G</h6>
                                        <h5 class="price"><span class="theme-color">$10.25</span> <del>$12.57</del>
                                        </h5>
                                        <div class="add-to-cart-box bg-white">
                                            <button class="btn btn-add-cart addcart-button">Add
                                                <span class="add-icon bg-light-gray">
                                                    <i class="fa-solid fa-plus"></i>
                                                </span>
                                            </button>
                                            <div class="cart_qty qty-box">
                                                <div class="input-group bg-white">
                                                    <button type="button" class="qty-left-minus bg-gray"
                                                        data-type="minus" data-field="">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                        name="quantity" value="0">
                                                    <button type="button" class="qty-right-plus bg-gray"
                                                        data-type="plus" data-field="">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="product-box-3 wow fadeInUp" data-wow-delay="0.05s">
                                <div class="product-header">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/cake/product/2.png"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>

                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#view">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                <a href="compare.html">
                                                    <i data-feather="refresh-cw"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <i data-feather="heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                                <div class="product-footer">
                                    <div class="product-detail">
                                        <span class="span-name">Vegetable</span>
                                        <a href="product-left-thumbnail.html">
                                            <h5 class="name">Fresh Bread and Pastry Flour 200 g</h5>
                                        </a>
                                        <div class="product-rating mt-2">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                            </ul>
                                            <span>(4.0)</span>
                                        </div>
                                        <h6 class="unit">250 ml</h6>
                                        <h5 class="price"><span class="theme-color">$08.02</span> <del>$15.15</del>
                                        </h5>
                                        <div class="add-to-cart-box bg-white">
                                            <button class="btn btn-add-cart addcart-button">Add
                                                <span class="add-icon bg-light-gray">
                                                    <i class="fa-solid fa-plus"></i>
                                                </span>
                                            </button>
                                            <div class="cart_qty qty-box">
                                                <div class="input-group bg-white">
                                                    <button type="button" class="qty-left-minus bg-gray"
                                                        data-type="minus" data-field="">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                        name="quantity" value="0">
                                                    <button type="button" class="qty-right-plus bg-gray"
                                                        data-type="plus" data-field="">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="product-box-3 wow fadeInUp" data-wow-delay="0.1s">
                                <div class="product-header">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/cake/product/3.png"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>

                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#view">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                <a href="compare.html">
                                                    <i data-feather="refresh-cw"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <i data-feather="heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="product-footer">
                                    <div class="product-detail">
                                        <span class="span-name">Vegetable</span>
                                        <a href="product-left-thumbnail.html">
                                            <h5 class="name">Peanut Butter Bite Premium Butter Cookies 600 g</h5>
                                        </a>
                                        <div class="product-rating mt-2">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                            </ul>
                                            <span>(2.4)</span>
                                        </div>
                                        <h6 class="unit">350 G</h6>
                                        <h5 class="price"><span class="theme-color">$04.33</span> <del>$10.36</del>
                                        </h5>
                                        <div class="add-to-cart-box bg-white">
                                            <button class="btn btn-add-cart addcart-button">Add
                                                <span class="add-icon bg-light-gray">
                                                    <i class="fa-solid fa-plus"></i>
                                                </span>
                                            </button>
                                            <div class="cart_qty qty-box">
                                                <div class="input-group bg-white">
                                                    <button type="button" class="qty-left-minus bg-gray"
                                                        data-type="minus" data-field="">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                        name="quantity" value="0">
                                                    <button type="button" class="qty-right-plus bg-gray"
                                                        data-type="plus" data-field="">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="product-box-3 wow fadeInUp" data-wow-delay="0.15s">
                                <div class="product-header">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/cake/product/4.png"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>

                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#view">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                <a href="compare.html">
                                                    <i data-feather="refresh-cw"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <i data-feather="heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="product-footer">
                                    <div class="product-detail">
                                        <span class="span-name">Snacks</span>
                                        <a href="product-left-thumbnail.html">
                                            <h5 class="name">SnackAmor Combo Pack of Jowar Stick and Jowar Chips</h5>
                                        </a>
                                        <div class="product-rating mt-2">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                            </ul>
                                            <span>(5.0)</span>
                                        </div>
                                        <h6 class="unit">570 G</h6>
                                        <h5 class="price"><span class="theme-color">$12.52</span> <del>$13.62</del>
                                        </h5>
                                        <div class="add-to-cart-box bg-white">
                                            <button class="btn btn-add-cart addcart-button">Add
                                                <span class="add-icon bg-light-gray">
                                                    <i class="fa-solid fa-plus"></i>
                                                </span>
                                            </button>
                                            <div class="cart_qty qty-box">
                                                <div class="input-group bg-white">
                                                    <button type="button" class="qty-left-minus bg-gray"
                                                        data-type="minus" data-field="">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                        name="quantity" value="0">
                                                    <button type="button" class="qty-right-plus bg-gray"
                                                        data-type="plus" data-field="">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="product-box-3 wow fadeInUp" data-wow-delay="0.2s">
                                <div class="product-header">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/cake/product/5.png"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>

                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#view">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                <a href="compare.html">
                                                    <i data-feather="refresh-cw"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <i data-feather="heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="product-footer">
                                    <div class="product-detail">
                                        <span class="span-name">Snacks</span>
                                        <a href="product-left-thumbnail.html">
                                            <h5 class="name">Yumitos Chilli Sprinkled Potato Chips 100 g</h5>
                                        </a>
                                        <div class="product-rating mt-2">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                            </ul>
                                            <span>(3.8)</span>
                                        </div>
                                        <h6 class="unit">100 G</h6>
                                        <h5 class="price"><span class="theme-color">$10.25</span> <del>$12.36</del>
                                        </h5>
                                        <div class="add-to-cart-box bg-white">
                                            <button class="btn btn-add-cart addcart-button">Add
                                                <span class="add-icon bg-light-gray">
                                                    <i class="fa-solid fa-plus"></i>
                                                </span>
                                            </button>
                                            <div class="cart_qty qty-box">
                                                <div class="input-group bg-white">
                                                    <button type="button" class="qty-left-minus bg-gray"
                                                        data-type="minus" data-field="">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                        name="quantity" value="0">
                                                    <button type="button" class="qty-right-plus bg-gray"
                                                        data-type="plus" data-field="">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="product-box-3 wow fadeInUp" data-wow-delay="0.25s">
                                <div class="product-header">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/cake/product/6.png"
                                                class="img-fluid blur-up lazyload" alt="">
                                        </a>

                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#view">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                <a href="compare.html">
                                                    <i data-feather="refresh-cw"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <i data-feather="heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="product-footer">
                                    <div class="product-detail">
                                        <span class="span-name">Vegetable</span>
                                        <a href="product-left-thumbnail.html">
                                            <h5 class="name">Fantasy Crunchy Choco Chip Cookies</h5>
                                        </a>
                                        <div class="product-rating mt-2">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                            </ul>
                                            <span>(4.0)</span>
                                        </div>

                                        <h6 class="unit">550 G</h6>

                                        <h5 class="price"><span class="theme-color">$14.25</span> <del>$16.57</del>
                                        </h5>
                                        <div class="add-to-cart-box bg-white">
                                            <button class="btn btn-add-cart addcart-button">Add
                                                <span class="add-icon bg-light-gray">
                                                    <i class="fa-solid fa-plus"></i>
                                                </span>
                                            </button>
                                            <div class="cart_qty qty-box">
                                                <div class="input-group bg-white">
                                                    <button type="button" class="qty-left-minus bg-gray"
                                                        data-type="minus" data-field="">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                        name="quantity" value="0">
                                                    <button type="button" class="qty-right-plus bg-gray"
                                                        data-type="plus" data-field="">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="product-box-3 wow fadeInUp" data-wow-delay="0.3s">
                                <div class="product-header">
                                    <div class="product-image">
                                        <a href="product-left-thumbnail.html">
                                            <img src="../assets/images/cake/product/7.png" class="img-fluid"
                                                alt="">
                                        </a>

                                        <ul class="product-option">
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#view">
                                                    <i data-feather="eye"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                <a href="compare.html">
                                                    <i data-feather="refresh-cw"></i>
                                                </a>
                                            </li>

                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                                <a href="wishlist.html" class="notifi-wishlist">
                                                    <i data-feather="heart"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="product-footer">
                                    <div class="product-detail">
                                        <span class="span-name">Vegetable</span>
                                        <a href="product-left-thumbnail.html">
                                            <h5 class="name">Fresh Bread and Pastry Flour 200 g</h5>
                                        </a>
                                        <div class="product-rating mt-2">
                                            <ul class="rating">
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star" class="fill"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                                <li>
                                                    <i data-feather="star"></i>
                                                </li>
                                            </ul>
                                            <span>(3.8)</span>
                                        </div>

                                        <h6 class="unit">1 Kg</h6>

                                        <h5 class="price"><span class="theme-color">$12.68</span> <del>$14.69</del>
                                        </h5>
                                        <div class="add-to-cart-box bg-white">
                                            <button class="btn btn-add-cart addcart-button">Add
                                                <span class="add-icon bg-light-gray">
                                                    <i class="fa-solid fa-plus"></i>
                                                </span>
                                            </button>
                                            <div class="cart_qty qty-box">
                                                <div class="input-group bg-white">
                                                    <button type="button" class="qty-left-minus bg-gray"
                                                        data-type="minus" data-field="">
                                                        <i class="fa fa-minus"></i>
                                                    </button>
                                                    <input class="form-control input-number qty-input" type="text"
                                                        name="quantity" value="0">
                                                    <button type="button" class="qty-right-plus bg-gray"
                                                        data-type="plus" data-field="">
                                                        <i class="fa fa-plus"></i>
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
    <!-- Related Product Section End -->
@endsection
@section('more-footer')
    <!-- Sticky Cart Box Start -->
    <div class="sticky-bottom-cart">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="cart-content">
                        <div class="product-image">
                            <img src="../assets/images/product/category/1.jpg" class="img-fluid blur-up lazyload"
                                alt="">
                            <div class="content">
                                <h5>Creamy Chocolate Cake</h5>
                                <h6>$32.96<del class="text-danger">$96.00</del><span>55% off</span></h6>
                            </div>
                        </div>
                        <div class="selection-section">
                            <div class="form-group mb-0">
                                <select id="input-state" class="form-control form-select">
                                    <option selected disabled>Choose Weight...</option>
                                    <option>1/2 KG</option>
                                    <option>1 KG</option>
                                    <option>1.5 KG</option>
                                </select>
                            </div>
                            <div class="cart_qty qty-box product-qty m-0">
                                <div class="input-group h-100">
                                    <button type="button" class="qty-left-minus" data-type="minus" data-field="">
                                        <i class="fa fa-minus"></i>
                                    </button>
                                    <input class="form-control input-number qty-input" type="text" name="quantity"
                                        value="1">
                                    <button type="button" class="qty-right-plus" data-type="plus" data-field="">
                                        <i class="fa fa-plus"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                        <div class="add-btn">
                            <a class="btn theme-bg-color text-white wishlist-btn" href="wishlist.html"><i
                                    class="fa fa-bookmark"></i> Wishlist</a>
                            <a class="btn theme-bg-color text-white" href="cart.html"><i
                                    class="fas fa-shopping-cart"></i> Add To Cart</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Sticky Cart Box End -->

    <!-- Review Modal Start -->
    <div class="modal fade theme-modal question-modal" id="writereview" tabindex="-1">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Write a review</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal">
                        <i class="fa-solid fa-xmark"></i>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="product-review-form">
                        <div class="product-wrapper">
                            <div class="product-image">
                                <img class="img-fluid" alt="Solid Collared Tshirts"
                                    src="../assets/images/fashion/product/26.jpg">
                            </div>
                            <div class="product-content">
                                <h5 class="name">Solid Collared Tshirts</h5>
                                <div class="product-review-rating">
                                    <div class="product-rating">
                                        <h6 class="price-number">$16.00</h6>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="review-box">
                            <div class="product-review-rating">
                                <label>Rating</label>
                                <div class="product-rating">
                                    <ul class="rating">
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star" class="fill"></i>
                                        </li>
                                        <li>
                                            <i data-feather="star"></i>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="review-box">
                            <label for="content" class="form-label">Your Question *</label>
                            <textarea id="content" rows="3" class="form-control" placeholder="Your Question"></textarea>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-md btn-theme-outline fw-bold"
                        data-bs-dismiss="modal">Close</button>
                    <button type="button" class="btn btn-md fw-bold text-light theme-bg-color">Save changes</button>
                </div>
            </div>
        </div>
    </div>
    <!-- Review Modal End -->
@endsection
@section('scripts')
    <!-- Price Range Js -->
    <script src="{{ asset('assets/js/ion.rangeSlider.min.js') }}"></script>
    <!-- sidebar open js -->
    <script src="{{ asset('assets/js/filter-sidebar.js') }}"></script>
    <!-- Zoom Js -->
    <script src="{{ asset('assets/js/jquery.elevatezoom.js') }}"></script>
    <script src="{{ asset('assets/js/zoom-filter.js') }}"></script>
    <!-- Sticky-bar js -->
    <script src="{{ asset('assets/js/sticky-cart-bottom.js') }}"></script>

    <script>
        $(document).ready(function() {
            $('#add-to-wishlist').on('click', function(e) {
                e.preventDefault();

                // Get the product ID from the data-product-id attribute
                var productId = $(this).data('product-id');

                // Perform an AJAX POST request
                $.ajax({
                    url: '/wishlist/add', // URL to send the POST request
                    type: 'POST',
                    data: {
                        product_id: productId,
                    },
                    success: function(response) {
                        if (response.type == 'added') {
                            toastr.success(response.message);
                            $('#heart-icon').css({
                                'color': 'red',
                                'fill': 'red'
                            });
                        } else {
                            toastr.error(response.message);
                            $('#heart-icon').removeAttr('style');
                        }
                    },
                    error: function(error) {
                        console.log(error);
                        if (error.status === 401) {
                            // User is unauthenticated, redirect to login page
                            window.location.href = '/login';
                        }
                        toastr.error(error.responseJSON.message);
                    }
                });
            });
        });

        $('.qty-right-plus').on('click', function(e) {
            e.preventDefault();
            var input = $(this).siblings('input[name="quantity"]');
            var newValue = parseInt(input.val()) + 1;

            if (newValue <= 4) {
                input.val(newValue);
                input.attr('data-button-pressed',
                    'plus'); // Set the data attribute to indicate the plus button was pressed
                // Enable the decrement button if the value becomes greater than 0
                input.siblings('.qty-left-minus').prop('disabled', false);
            }

            // Disable the increment button if the value becomes 4
            if (newValue === 4) {
                $(this).prop('disabled', true);
            }
        });

        $('.qty-left-minus').on('click', function(e) {
            e.preventDefault();
            var input = $(this).siblings('input[name="quantity"]');
            var newValue = parseInt(input.val()) - 1;

            if (newValue >= 1) {
                input.val(newValue);
                input.attr('data-button-pressed',
                    'minus'); // Set the data attribute to indicate the minus button was pressed
                // Enable the increment button if the value becomes less than 4
                input.siblings('.qty-right-plus').prop('disabled', false);
            }

            // Disable the decrement button if the value becomes 0
            if (newValue === 1) {
                $(this).prop('disabled', true);
            }
        });
    </script>
@endsection
