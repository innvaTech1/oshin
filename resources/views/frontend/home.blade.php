@extends('frontend.layouts.master')
@section('title', 'Home Page')
@section('content')
    <!-- home section start -->
    <section class="home-section-2 home-section-small section-b-space">
        <div class="container-fluid-lg">
            <div class="row g-4">
                <div class="col-xxl-6 col-md-8">
                    <div class="home-contain h-100 position-relative">
                        <img src="{{ asset('uploads/3.jpg') }}" class="img-fluid bg-img blur-up lazyload" alt="">
                        <div class="home-detail home-width p-center-left position-absolute top-50 start-50 translate-middle"
                            style="width:100%;background-color: rgba(0, 0, 0, 0.5); z-index: 1;">
                            <div>
                                <h1 class="fw-bold w-100 text-white">100% Cotton</h1>
                                <h3 class="text-content fw-light text-white">Fashion Wears</h3>
                                <p class="d-sm-block d-none text-white">Free shipping on all your order. we deliver you
                                    enjoy</p>
                                <button onclick="javascript:void(0)"
                                    class="btn mt-sm-4 btn-2 theme-bg-color text-white mend-auto btn-2-animation">Shop
                                    Now</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xxl-3 col-md-4 ratio_medium d-md-block d-none">
                    <div class="home-contain home-small h-100 position-relative">
                        <img src="{{ asset('uploads/4.jpg') }}" class="img-fluid bg-img blur-up lazyload" alt="">
                        <div class="overlay"
                            style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;">
                        </div>
                        <div class="home-detail text-center p-absolute-center w-100 text-white"
                            style="position: absolute; top: 50%; left: 50%; transform: translate(-50%, -50%); z-index: 2;">
                            <div style="height: 100%;display: flex;flex-direction: column;justify-content: flex-end;">
                                <h4 class="fw-bold">100% Cotton</h4>
                                <h5 class="text-center">Fashion House</h5>
                                <button class="btn bg-white theme-color mt-3 home-button mx-auto btn-2"
                                    onclick="javascript:void(0)">Shop Now</button>
                            </div>
                        </div>
                    </div>
                </div>


                <div class="col-xxl-3 ratio_65 d-xxl-block d-none">
                    <div class="row g-3">
                        <div class="col-xxl-12 col-sm-6">
                            <div class="home-contain position-relative">
                                <a href="#">
                                    <img src="{{ asset('uploads/1.jpg') }}" class="img-fluid bg-img blur-up lazyload"
                                        alt="">
                                </a>
                                <div class="overlay"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;">
                                </div>
                                <div class="home-detail text-white p-center text-center position-absolute top-50 start-50 translate-middle"
                                    style="z-index: 2;">
                                    <div>
                                        <h4 class="text-center">Lifestyle</h4>
                                        <h5 class="text-center">Best Weekend Sales</h5>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xxl-12 col-sm-6">
                            <div class="home-contain position-relative">
                                <a href="#">
                                    <img src="{{ asset('uploads/9.jpg') }}" class="img-fluid bg-img blur-up lazyload"
                                        alt="">
                                </a>
                                <div class="overlay"
                                    style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; background-color: rgba(0, 0, 0, 0.5); z-index: 1;">
                                </div>
                                <div class="home-detail text-white w-50 p-center-left home-p-sm position-absolute top-50 start-0 translate-middle-y"
                                    style="z-index: 2;">
                                    <div>
                                        <h4 class="fw-bold">Fashion</h4>
                                        <h5>Discount Offer</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </section>
    <!-- Home Section End -->
    <!-- Category Section Start -->
    <section class="category-section-2">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Shop By Categories</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="category-slider arrow-slider">
                        @foreach ($categories as $category)
                            <div>
                                <div class="shop-category-box border-0 wow fadeIn">
                                    <a href="{{ route('products', ['category' => $category->id]) }}">
                                        <img src="{{ $category->image }}" class="img-fluid blur-up lazyload"
                                            style="width:200px;height:200px;object-fit:cover;object-position: top;"
                                            alt="{{ $category->slug }}">
                                    </a>
                                    <div class="category-name">
                                        <h6>{{ $category->name }}</h6>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Category Section End -->

    <!-- Value Section Start -->
    <section>
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Best Value</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="three-slider arrow-slider ratio_65">
                        <div>
                            <div class="offer-banner hover-effect">
                                <img src="{{ asset('uploads/11.jpg') }}" class="img-fluid bg-img blur-up lazyload"
                                    alt="">
                                <div class="banner-detail">
                                    <h5 class="theme-color">Buy more, Save more</h5>
                                    <h6>Pure Cotton</h6>
                                </div>
                                <div class="offer-box">
                                    <button onclick="javascript:void(0)"
                                        class="btn-category btn theme-bg-color text-white">View Offer</button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="offer-banner hover-effect">
                                <img src="{{ asset('uploads/12.jpg') }}" class="img-fluid bg-img blur-up lazyload"
                                    alt="">
                                <div class="banner-detail">
                                    <h5 class="theme-color">Save More!</h5>
                                    <h6>Fashion</h6>
                                </div>
                                <div class="offer-box">
                                    <button onclick="location.href = '/';"
                                        class="btn-category btn theme-bg-color text-white">View Offer</button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="offer-banner hover-effect">
                                <img src="{{ asset('uploads/13.jpg') }}" class="img-fluid bg-img blur-up lazyload"
                                    alt="">
                                <div class="banner-detail">
                                    <h5 class="theme-color">Hot Deals!</h5>
                                    <h6>Fashion</h6>
                                </div>
                                <div class="offer-box">
                                    <button onclick="location.href = '/';"
                                        class="btn-category btn theme-bg-color text-white">View Offer</button>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="offer-banner hover-effect">
                                <img src="{{ asset('uploads/14.jpg') }}" class="img-fluid bg-img blur-up lazyload"
                                    alt="">
                                <div class="banner-detail">
                                    <h5 class="theme-color">Buy more, Save more</h5>
                                    <h6>Fashion</h6>
                                </div>
                                <div class="offer-box">
                                    <button onclick="location.href = '/';"
                                        class="btn-category btn theme-bg-color text-white">View
                                        Offer</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Value Section End -->

    <!-- Deal Section Start -->
    {{-- <section class="deal-section">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Deal Of The Day</h2>
            </div>
            <div class="row">
                <div class="col-12">
                    <div class="three-slider-1 arrow-slider">
                        <div>
                            <div class="deal-box wow fadeInUp">
                                <a href="shop-left-sidebar.html" class="category-image order-sm-2">
                                    <img src="../assets/images/veg-3/cate1/1.png" class="img-fluid blur-up lazyload"
                                        alt="">
                                </a>

                                <div class="deal-detail order-sm-1">
                                    <button class="buy-box btn theme-bg-color text-white btn-cart">
                                        <i class="iconly-Buy icli m-0"></i>
                                    </button>
                                    <div class="hot-deal">
                                        <span>Hot Deals</span>
                                    </div>
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
                                    <a href="shop-left-sidebar.html" class="text-title">
                                        <h5>Bell pepper</h5>
                                    </a>
                                    <h5 class="price">$70.21 <span>$65.00</span></h5>
                                    <div class="progress custom-progressbar">
                                        <div class="progress-bar" style="width: 50%" role="progressbar"></div>
                                    </div>
                                    <h4 class="item">Sold: <span>30 Items</span></h4>
                                    <h4 class="offer">Hurry up offer end in</h4>
                                    <div class="timer" id="clockdiv-4" data-hours="1" data-minutes="2"
                                        data-seconds="3">
                                        <ul>
                                            <li>
                                                <div class="counter">
                                                    <div class="days">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="hours">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="minutes">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="seconds">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="deal-box wow fadeInUp" data-wow-delay="0.05s">
                                <a href="shop-left-sidebar.html" class="category-image order-sm-2">
                                    <img src="../assets/images/veg-3/cate1/2.png" class="img-fluid blur-up lazyload"
                                        alt="">
                                </a>

                                <div class="deal-detail order-sm-1">
                                    <button class="buy-box btn theme-bg-color text-white btn-cart">
                                        <i class="iconly-Buy icli m-0"></i>
                                    </button>
                                    <div class="hot-deal">
                                        <span>Hot Deals</span>
                                    </div>
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
                                    <a href="shop-left-sidebar.html" class="text-title">
                                        <h5>Eggplant</h5>
                                    </a>
                                    <h5 class="price">$70.21 <span>$65.00</span></h5>
                                    <div class="progress custom-progressbar">
                                        <div class="progress-bar" style="width: 50%" role="progressbar"></div>
                                    </div>
                                    <h4 class="item">Sold: <span>30 Items</span></h4>
                                    <h4 class="offer">Hurry up offer end in</h4>
                                    <div class="timer" id="clockdiv-1" data-hours="1" data-minutes="2"
                                        data-seconds="3">
                                        <ul>
                                            <li>
                                                <div class="counter">
                                                    <div class="days">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="hours">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="minutes">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="seconds">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="deal-box wow fadeInUp" data-wow-delay="0.1s">
                                <a href="shop-left-sidebar.html" class="category-image order-sm-2">
                                    <img src="../assets/images/veg-3/cate1/3.png" class="img-fluid blur-up lazyload"
                                        alt="">
                                </a>

                                <div class="deal-detail order-sm-1">
                                    <button class="buy-box btn theme-bg-color text-white btn-cart">
                                        <i class="iconly-Buy icli m-0"></i>
                                    </button>
                                    <div class="hot-deal">
                                        <span>Hot Deals</span>
                                    </div>
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
                                    <a href="shop-left-sidebar.html" class="text-title">
                                        <h5>Onion</h5>
                                    </a>
                                    <h5 class="price">$70.21 <span>$65.00</span></h5>
                                    <div class="progress custom-progressbar">
                                        <div class="progress-bar" style="width: 50%" role="progressbar"></div>
                                    </div>
                                    <h4 class="item">Sold: <span>30 Items</span></h4>
                                    <h4 class="offer">Hurry up offer end in</h4>
                                    <div class="timer" id="clockdiv-2" data-hours="1" data-minutes="2"
                                        data-seconds="3">
                                        <ul>
                                            <li>
                                                <div class="counter">
                                                    <div class="days">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="hours">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="minutes">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="seconds">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="deal-box wow fadeInUp" data-wow-delay="0.15s">
                                <div class="category-image order-sm-2">
                                    <img src="../assets/images/veg-3/cate1/1.png" class="img-fluid" alt="">
                                </div>

                                <div class="deal-detail order-sm-1">
                                    <button class="buy-box btn theme-bg-color text-white btn-cart">
                                        <i class="iconly-Buy icli m-0"></i>
                                    </button>
                                    <div class="hot-deal">
                                        <span>Hot Deals</span>
                                    </div>
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
                                    <a href="shop-left-sidebar.html" class="text-title">
                                        <h5>Bell pepper</h5>
                                    </a>
                                    <h5 class="price">$70.21 <span>$65.00</span></h5>
                                    <div class="progress custom-progressbar">
                                        <div class="progress-bar" style="width: 50%" role="progressbar"></div>
                                    </div>
                                    <h4 class="item">Sold: <span>30 Items</span></h4>
                                    <h4 class="offer">Hurry up offer end in</h4>
                                    <div class="timer" id="clockdiv-3" data-hours="1" data-minutes="2"
                                        data-seconds="3">
                                        <ul>
                                            <li>
                                                <div class="counter">
                                                    <div class="days">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="hours">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="minutes">
                                                        <h6></h6>
                                                    </div>
                                                </div>
                                            </li>
                                            <li>
                                                <div class="counter">
                                                    <div class="seconds">
                                                        <h6></h6>
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
    </section> --}}
    <!-- Deal Section End -->

    <!-- Product Section Start -->
    <section class="product-section">
        <div class="container-fluid-lg">
            <div class="title title-flex-2">
                <h2>Our Products</h2>
                {{-- <ul class="nav nav-tabs tab-style-color-2 tab-style-color" id="myTab">
                    <li class="nav-item">
                        <button class="nav-link btn active" id="all-tab" data-bs-toggle="tab" data-bs-target="#all"
                            type="button">All</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link btn" id="cooking-tab" data-bs-toggle="tab" data-bs-target="#cooking"
                            type="button"> Cooking</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link btn" id="fruits-tab" data-bs-toggle="tab" data-bs-target="#fruits"
                            type="button">Fruits & Vegetables</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link btn" id="beverage-tab" data-bs-toggle="tab" data-bs-target="#beverage"
                            type="button">Beverage</button>
                    </li>

                    <li class="nav-item">
                        <button class="nav-link btn" id="dairy-tab" data-bs-toggle="tab" data-bs-target="#dairy"
                            type="button">Dairy</button>
                    </li>
                </ul> --}}
            </div>

            <div class="tab-content" id="myTabContent">
                <div class="tab-pane fade show active" id="all" role="tabpanel">
                    <div class="row g-8">
                        @foreach ($products as $product)
                            <div class="col-xxl-3 col-lg-3 col-md-4 col-6 wow fadeInUp product-wrapper"
                                data-wow-delay="0.1s">
                                <div class="product-box-4" data-slug="{{ $product->slug }}">
                                    <div class="product-image">
                                        <div class="label-flex">
                                            {{-- <div class="discount">
                                                <label>50%</label>
                                            </div> --}}

                                            <button class="btn p-0 wishlist btn-wishlist notifi-wishlist"
                                                data-product-id={{ $product->id }}>
                                                <i class="iconly-Heart icli"
                                                    @if ($product->wishlists && !$product->wishlists->isEmpty()) style="color: red;" @endif></i>
                                            </button>
                                        </div>

                                        <a href="{{ route('productDetails', ['slug' => $product->slug]) }}">
                                            <img src="{{ asset($product->thumbnail_image_source) }}" class="img-fluid"
                                                style="width:100%;height: fit-content;" alt="{{ $product->slug }}">
                                        </a>

                                        <ul class="option">
                                            <li class="quick-view-btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                                title="Quick View">
                                                <a href="javascript:void(0)" data-bs-toggle="modal"
                                                    data-bs-target="#view">
                                                    <i class="iconly-Show icli"></i>
                                                </a>
                                            </li>
                                            <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                                <a href="javascript:void(0)" class="add-to-compare"
                                                data-product-id="{{ $product->id }}">
                                                    <i class="iconly-Swap icli"></i>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="product-detail">
                                        <ul class="rating">
                                            @for ($i = 1; $i <= 5; $i++)
                                                @if ($i <= $product->avg_rating)
                                                    <li><i data-feather="star" class="fill"></i></li>
                                                @else
                                                    <li><i data-feather="star"></i></li>
                                                @endif
                                            @endfor
                                        </ul>
                                        <a href="{{ route('productDetails', $product->slug) }}">
                                            <h5 class="name">{{ $product->product_name }}</h5>
                                        </a>
                                        <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                        {{-- quicek view details starts --}}
                                        <input type="hidden" class="product-id" value="{{ $product->id }}">
                                        <input type="hidden" class="product-description"
                                            value="{{ $product->description }}">
                                        <input type="hidden" class="product-brand" value="{{ $product->brand->name }}">
                                        <input type="hidden" class="product-type" value="{{ $product->product_type }}">
                                        <input type="hidden" class="product-slug" value="{{ $product->slug }}">
                                        {{-- quicek view details end --}}
                                        <div class="price-qty">
                                            <div class="counter-number">
                                                <div class="counter">
                                                    <div class="qty-left-minus" data-type="minus" data-field="">
                                                        <i class="fa-solid fa-minus"></i>
                                                    </div>
                                                    @if (session()->has('cart'))
                                                        @php $found = false; @endphp
                                                        @foreach (session()->get('cart') as $productId => $item)
                                                            @if ($productId == $product->id)
                                                                <input data-qty-reset="{{ $product->id }}"
                                                                    class="form-control input-number qty-input"
                                                                    type="text" name="quantity"
                                                                    value="{{ $item['quantity'] }}">
                                                                @php $found = true; @endphp
                                                            @break
                                                        @endif
                                                    @endforeach
                                                    @if (!$found)
                                                        <input data-qty-reset="{{ $product->id }}"
                                                            class="form-control input-number qty-input" type="text"
                                                            name="quantity" value="0">
                                                    @endif
                                                @else
                                                    <input data-qty-reset="{{ $product->id }}"
                                                        class="form-control input-number qty-input" type="text"
                                                        name="quantity" value="0">
                                                @endif

                                                <div class="qty-right-plus" data-type="plus" data-field="">
                                                    <i class="fa-solid fa-plus"></i>
                                                </div>
                                            </div>
                                        </div>

                                        <button class="buy-button buy-button-2 btn btn-cart"
                                            data-product-id={{ $product->id }}>
                                            <i class="iconly-Buy icli text-white m-0"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
                <div class="d-flex justify-content-end">
                    <a href="{{ route('products') }}" class="btn mt-3 btn-2"
                        style="background-color: var(--theme-color); color: white;">See More</a>

                </div>
            </div>

            <div class="tab-pane fade" id="cooking" role="tabpanel">
                <div class="row g-8">
                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="#">
                                    <img src="../assets/images/veg-3/cate1/1.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="#">
                                    <h5 class="name">Eggplant</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="#">
                                    <img src="../assets/images/veg-3/cate1/2.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="#">
                                    <h5 class="name">Eggplant</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="#">
                                    <img src="../assets/images/veg-3/cate1/3.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="#">
                                    <h5 class="name">Onion</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="#">
                                    <img src="../assets/images/veg-3/cate1/4.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="#">
                                    <h5 class="name">Potato</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="#">
                                    <img src="../assets/images/veg-3/cate1/5.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="#">
                                    <h5 class="name">Baby Chili</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/6.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Broccoli</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/10.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Pea</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/11.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Cucumber</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/17.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Cabbage</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/18.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Ginger</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="fruits" role="tabpanel">
                <div class="row g-8">
                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/8.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Apple</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/14.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Passion</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/16.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Blackberry</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/7.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Peru</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/9.png" class="img-fluid" alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Apple</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/13.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Strawberry</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/12.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Bell pepper</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="beverage" role="tabpanel">
                <div class="row g-8">
                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/1.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Eggplant</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/2.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Eggplant</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/3.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Onion</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/4.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Potato</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/5.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Baby Chili</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/6.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Broccoli</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/10.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Pea</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/11.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Cucumber</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/17.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Cabbage</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/18.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Ginger</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="tab-pane fade" id="dairy" role="tabpanel">
                <div class="row g-8">
                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/1.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Eggplant</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/2.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Eggplant</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/3.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Onion</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/4.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Potato</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/5.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Baby Chili</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/6.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Broccoli</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/10.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Pea</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/11.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Cucumber</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/17.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Cabbage</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-xxl-2 col-lg-3 col-md-4 col-6">
                        <div class="product-box-4">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist">
                                        <i class="iconly-Heart icli"></i>
                                    </button>
                                </div>

                                <a href="product-left-thumbnail.html">
                                    <img src="../assets/images/veg-3/cate1/18.png" class="img-fluid"
                                        alt="">
                                </a>

                                <ul class="option">
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="compare.html">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
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
                                <a href="product-left-thumbnail.html">
                                    <h5 class="name">Ginger</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            <input class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                            <div class="qty-right-plus" data-type="plus" data-field="">
                                                <i class="fa-solid fa-plus"></i>
                                            </div>
                                        </div>
                                    </div>

                                    <button class="buy-button buy-button-2 btn btn-cart">
                                        <i class="iconly-Buy icli text-white m-0"></i>
                                    </button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Product Section End -->

<!-- Banner Section Start -->
{{-- <section class="banner-section">
        <div class="container-fluid-lg">
            <div class="row gy-xl-0 gy-3">
                <div class="col-xl-6">
                    <div class="banner-contain-3 hover-effect">
                        <img src="../assets/images/veg-3/banner/1.png" class="bg-img img-fluid" alt="">
                        <div
                            class="banner-detail banner-details-dark text-white p-center-left w-50 position-relative mend-auto">
                            <div>
                                <h6 class="ls-expanded text-uppercase">Premium</h6>
                                <h3 class="mb-sm-3 mb-1">Fresh Vegetable & Daily Eating</h3>
                                <h4>Get Extra 50% Off</h4>
                                <button class="btn theme-color bg-white btn-md fw-bold mt-sm-3 mt-1 mend-auto"
                                    onclick="location.href = 'shop-left-sidebar.html';">Shop Now</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-xl-6">
                    <div class="banner-contain-3 hover-effect">
                        <img src="../assets/images/veg-3/banner/2.png" class="bg-img img-fluid" alt="">
                        <div class="banner-detail text-dark p-center-left w-50 position-relative mend-auto">
                            <div>
                                <h6 class=" ls-expanded text-uppercase">available</h6>
                                <h3 class="mb-sm-3 mb-1">100% Natural & Healthy Fruits</h3>
                                <h4 class="text-content">Weekend Special</h4>
                                <button class="btn theme-bg-color text-white btn-md fw-bold mt-sm-3 mt-1 mend-auto"
                                    onclick="location.href = 'shop-left-sidebar.html';">Shop Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
<!-- Banner Section End -->

<!-- Product Section Start -->
{{-- <section class="product-section-2">
        <div class="container-fluid-lg">
            <div class="row gy-sm-5 gy-4">
                <div class="col-xxl-3 col-md-6">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="title title-border d-block">
                                <h3>NEW PRODUCTS</h3>
                            </div>

                            <div class="product-category-1 arrow-slider-2">
                                <div>
                                    <div class="row gy-sm-4 gy-3">
                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/1.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Tomato</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/2.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Red onion</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp pb-1" data-wow-delay="0.1s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/3.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
                                                    <ul class="rating">
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
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                    </ul>
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Carrot</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="row gy-sm-4 gy-3">
                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/4.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Potato</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/5.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Broccoli</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp pb-1" data-wow-delay="0.1s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/6.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Carrot</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
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

                <div class="col-xxl-3 col-md-6">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="title title-border d-block">
                                <h3>FEATURE PRODUCT</h3>
                            </div>

                            <div class="product-category-1 arrow-slider-2">
                                <div>
                                    <div class="row gy-sm-4 gy-3">
                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/7.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
                                                    <ul class="rating">
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
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                    </ul>
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Garlic</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/8.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Beetroot</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 pb-1 wow fadeInUp" data-wow-delay="0.1s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/9.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Eggplant</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="row gy-sm-4 gy-3">
                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/10.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Bell pepper</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/11.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Pea</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp pb-1" data-wow-delay="0.1s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/12.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
                                                    <ul class="rating">
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
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                    </ul>
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Avocado</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
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

                <div class="col-xxl-3 col-md-6">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="title title-border d-block">
                                <h3>BEST SELLER</h3>
                            </div>

                            <div class="product-category-1 arrow-slider-2">
                                <div>
                                    <div class="row gy-sm-4 gy-3">
                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/1.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Tomato</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/2.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Red onion</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp pb-1" data-wow-delay="0.1s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/3.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
                                                    <ul class="rating">
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
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                    </ul>
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Carrot</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="row gy-sm-4 gy-3">
                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/4.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Potato</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/5.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Broccoli</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp pb-1" data-wow-delay="0.1s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/6.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Carrot</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
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

                <div class="col-xxl-3 col-md-6">
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="title title-border d-block">
                                <h3>ON SELL</h3>
                            </div>

                            <div class="product-category-1 arrow-slider-2">
                                <div>
                                    <div class="row gy-sm-4 gy-3">
                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/7.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
                                                    <ul class="rating">
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
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                    </ul>
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Garlic</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/8.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Beetroot</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp pb-1" data-wow-delay="0.1s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/9.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Eggplant</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div>
                                    <div class="row gy-sm-4 gy-3">
                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/10.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Bell pepper</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp" data-wow-delay="0.05s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/11.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
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
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Pea</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="product-box-4 wow fadeInUp pb-1" data-wow-delay="0.1s">
                                                <a href="shop-left-sidebar.html" class="product-image">
                                                    <img src="../assets/images/veg-3/pro1/12.png" class="img-fluid"
                                                        alt="">
                                                </a>
                                                <div class="product-details">
                                                    <ul class="rating">
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
                                                        <li>
                                                            <i data-feather="star"></i>
                                                        </li>
                                                    </ul>
                                                    <a href="product-left-thumbnail.html">
                                                        <h4 class="name">Avocado</h4>
                                                    </a>
                                                    <h5 class="price">$75.20<del>$65.21</del></h5>
                                                    <ul class="option">
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Add to Cart">
                                                            <a href="cart.html">
                                                                <i class="iconly-Buy icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Quick View">
                                                            <a href="javascript:void(0)" data-bs-toggle="modal"
                                                                data-bs-target="#exampleModal">
                                                                <i class="iconly-Show icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Wishlist">
                                                            <a href="wishlist.html">
                                                                <i class="iconly-Heart icli"></i>
                                                            </a>
                                                        </li>
                                                        <li data-bs-toggle="tooltip" data-bs-placement="top"
                                                            title="Compare">
                                                            <a href="compare.html">
                                                                <i class="iconly-Swap icli"></i>
                                                            </a>
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
        </div>
    </section>
    <!-- Product Section End -->

    <!-- Banner Section Start -->
    <section class="banner-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="banner-contain-3 section-b-space section-t-space hover-effect">
                        <img src="../assets/images/veg-3/banner/3.png" class="img-fluid bg-img" alt="">
                        <div class="banner-detail p-center text-dark position-relative text-center p-0">
                            <div>
                                <h4 class="ls-expanded text-uppercase theme-color">Try Our New</h4>
                                <h2 class="my-3">100% Organic Best Quality Best Price</h2>
                                <h4 class="text-content fw-300">Best Fastkart Food Quality</h4>
                                <button class="btn theme-bg-color mt-sm-4 btn-md mx-auto text-white fw-bold"
                                    onclick="location.href = 'shop-left-sidebar.html';">Shop Now</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
<!-- Banner Section End -->

<!-- Product Section Start -->
<section class="product-section">
    <div class="container-fluid-lg">
        <div class="title">
            <h2>Top Products</h2>
        </div>

        <div class="slider-6 img-slider slick-slider-1 arrow-slider">
            @foreach ($top_products->chunk(2) as $chunk)
                <div>
                    @foreach ($chunk as $product)
                        <div class="product-box-4 wow fadeInUp" data-slug="{{ $product->slug }}">
                            <div class="product-image">
                                <div class="label-flex">
                                    <button class="btn p-0 wishlist btn-wishlist notifi-wishlist"
                                        data-product-id={{ $product->id }}>
                                        <i class="iconly-Heart icli"
                                            @if ($product->wishlists && !$product->wishlists->isEmpty()) style="color: red;" @endif></i>
                                    </button>
                                </div>

                                <a href="{{ route('productDetails', ['slug' => $product->slug]) }}">
                                    <img src="{{ asset($product->thumbnail_image_source) }}" class="img-fluid"
                                        style="width:100%;height: fit-content;" alt="{{ $product->slug }}">
                                </a>

                                <ul class="option">
                                    <li class="quick-view-btn" data-bs-toggle="tooltip" data-bs-placement="top"
                                        title="Quick View">
                                        <a href="javascript:void(0)" data-bs-toggle="modal"
                                            data-bs-target="#view">
                                            <i class="iconly-Show icli"></i>
                                        </a>
                                    </li>
                                    <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                        <a href="javascript:void(0)" class="add-to-compare"
                                        data-product-id="{{ $product->id }}">
                                            <i class="iconly-Swap icli"></i>
                                        </a>
                                    </li>
                                </ul>
                            </div>

                            <div class="product-detail">
                                <ul class="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $product->avg_rating)
                                            <li><i data-feather="star" class="fill"></i></li>
                                        @else
                                            <li><i data-feather="star"></i></li>
                                        @endif
                                    @endfor
                                </ul>
                                <a href="{{ route('productDetails', ['slug' => $product->slug]) }}">
                                    <h5 class="name">{{ $product->product_name }}</h5>
                                </a>
                                <h5 class="price theme-color">$70.21<del>$65.25</del></h5>
                                <div class="price-qty">
                                    <div class="counter-number">
                                        <div class="counter">
                                            <div class="qty-left-minus" data-type="minus" data-field="">
                                                <i class="fa-solid fa-minus"></i>
                                            </div>
                                            @if (session()->has('cart'))
                                                @php $found = false; @endphp
                                                @foreach (session()->get('cart') as $productId => $item)
                                                    @if ($productId == $product->id)
                                                        <input data-qty-reset="{{ $product->id }}"
                                                            class="form-control input-number qty-input"
                                                            type="text" name="quantity"
                                                            value="{{ $item['quantity'] }}">
                                                        @php $found = true; @endphp
                                                    @break
                                                @endif
                                            @endforeach
                                            @if (!$found)
                                                <input data-qty-reset="{{ $product->id }}"
                                                    class="form-control input-number qty-input" type="text"
                                                    name="quantity" value="0">
                                            @endif
                                        @else
                                            <input data-qty-reset="{{ $product->id }}"
                                                class="form-control input-number qty-input" type="text"
                                                name="quantity" value="0">
                                        @endif
                                        <div class="qty-right-plus" data-type="plus" data-field="">
                                            <i class="fa-solid fa-plus"></i>
                                        </div>
                                    </div>
                                </div>
                                <input type="hidden" class="product-id" value="{{ $product->id }}">
                                <input type="hidden" class="product-description"
                                    value="{{ $product->description }}">
                                <input type="hidden" class="product-brand"
                                    value="{{ $product->brand->name }}">
                                <input type="hidden" class="product-type"
                                    value="{{ $product->product_type }}">
                                <input type="hidden" class="product-slug" value="{{ $product->slug }}">

                                <button class="buy-button buy-button-2 btn btn-cart"
                                    data-product-id={{ $product->id }}>
                                    <i class="iconly-Buy icli text-white m-0"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        @endforeach
    </div>
</div>
</section>
<!-- Product Section End -->

<!-- Blog Section Start -->
{{-- <section class="blog-section">
        <div class="container-fluid-lg">
            <div class="title">
                <h2>Blog</h2>
            </div>

            <div class="slider-3 arrow-slider">
                <div>
                    <div class="blog-box ratio_50">
                        <div class="blog-box-image">
                            <a href="blog-detail.html">
                                <img src="../assets/images/veg-3/blog/1.jpg" class="img-fluid bg-img" alt="">
                            </a>
                        </div>

                        <div class="blog-detail">
                            <label>Conversion rate optimization</label>
                            <a href="blog-detail.html">
                                <h2>A Fresh Vegetable online market place a fresh...</h2>
                            </a>
                            <div class="blog-list">
                                <span>March 9, 2021</span>
                                <span>By Emil Kristensen</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="blog-box ratio_50">
                        <div class="blog-box-image">
                            <a href="blog-detail.html">
                                <img src="../assets/images/veg-3/blog/2.jpg" class="img-fluid bg-img" alt="">
                            </a>
                        </div>

                        <div class="blog-detail">
                            <label>Email Marketing</label>
                            <a href="blog-detail.html">
                                <h2>A Fresh Vegetable online market place a fresh...</h2>
                            </a>
                            <div class="blog-list">
                                <span>March 9, 2021</span>
                                <span>By Emil Kristensen</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="blog-box ratio_50">
                        <div class="blog-box-image">
                            <a href="blog-detail.html">
                                <img src="../assets/images/veg-3/blog/3.jpg" class="img-fluid bg-img" alt="">
                            </a>
                        </div>

                        <div class="blog-detail">
                            <label>Conversion rate optimization</label>
                            <a href="blog-detail.html">
                                <h2>A Fresh Vegetable online market place a fresh...</h2>
                            </a>
                            <div class="blog-list">
                                <span>March 9, 2021</span>
                                <span>By Emil Kristensen</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div>
                    <div class="blog-box ratio_50">
                        <div class="blog-box-image">
                            <a href="blog-detail.html">
                                <img src="../assets/images/veg-3/blog/1.jpg" class="img-fluid bg-img" alt="">
                            </a>
                        </div>

                        <div class="blog-detail">
                            <label>Conversion rate optimization</label>
                            <a href="blog-detail.html">
                                <h2>A Fresh Vegetable online market place a fresh...</h2>
                            </a>
                            <div class="blog-list">
                                <span>March 9, 2021</span>
                                <span>By Emil Kristensen</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Blog Section End -->

    <!-- Newsletter Section Start -->
    <section class="newsletter-section-2 section-b-space">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="newsletter-box hover-effect">
                        <img src="../assets/images/veg-3/shape/background.png" class="img-fluid bg-img"
                            alt="">

                        <div class="row">
                            <div class="col-xxl-8 col-xl-7">
                                <div class="newsletter-detail p-center-left text-white">
                                    <div>
                                        <h2>Subscribe to the newsletter</h2>
                                        <h4>Join our subscribers list to get the latest news, updates and special offers
                                            delivered directly in your inbox.</h4>
                                        <form class="row g-2">
                                            <div class="col-sm-10 col-12">
                                                <div class="newsletter-form">
                                                    <input type="email" class="form-control" id="email"
                                                        placeholder="Enter your email">
                                                    <button type="submit"
                                                        class="btn bg-white theme-color btn-md fw-500
                                                            submit-button">Subscribe</button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>

                            <div class="col-xxl-4 col-xl-5 d-xl-block d-none">
                                <div class="shape-box">
                                    <img src="../assets/images/veg-3/shape/basket.png" alt=""
                                        class="img-fluid image-1">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}
<!-- Newsletter Section End -->
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.category-slider .slick-slide').removeAttr('style');

        // add to cart
        $('.btn-cart').on('click', function(e) {
            e.preventDefault();
            // Get the product ID from the data-product-id attribute
            var productId = $(this).data('product-id');
            // Get the quantity from the input field
            var quantityInput = $(this).closest('.product-box-4').find('input[name="quantity"]');
            var quantity = quantityInput.val();
            if (parseInt(quantity) === 0) {
                quantityInput.val(1); // Update the input field value
                quantity = 1; // Update the quantity variable
            }
            // Perform an AJAX POST request
            callAddToCart(productId, quantity);
        });

        // Increase quantity
        $('.qty-right-plus').on('click', function(e) {
            e.preventDefault();
            var input = $(this).prev('input[name="quantity"]');
            var newValue = parseInt(input.val()) + 1;
            input.val(newValue);
        });

        // Decrease quantity
        $('.qty-left-minus').on('click', function(e) {
            e.preventDefault();
            var input = $(this).next('input[name="quantity"]');
            var newValue = parseInt(input.val()) - 1;
            if (newValue >= 0) {
                input.val(newValue);
            }
        });

        // ADD TO WISHLIST
        $('.btn-wishlist').on('click', function(e) {
            e.preventDefault();

            // Get the product ID from the data-product-id attribute
            var productId = $(this).data('product-id');
            var icon = $(this).find('.iconly-Heart');
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
                        icon.css({
                            'color': 'red',
                            'fill': 'red'
                        });
                    } else {
                        toastr.error(response.message);
                        icon.removeAttr('style');
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


        /**=====================
             Quice View
        ==========================**/
        // update quicek view modal content
        $('.quick-view-btn').on('click', function() {
            var productId = $(this).closest('.product-box-4').find('.product-id').val();
            var productSlug = $(this).closest('.product-box-4').find('.product-slug').val();
            var productName = $(this).closest('.product-box-4').find('.name').text();
            var productImage = $(this).closest('.product-box-4').find('.img-fluid').attr('src');
            var productDescription = $(this).closest('.product-box-4').find('.product-description')
                .val();
            var productBrand = $(this).closest('.product-box-4').find('.product-brand').val();
            var productType = $(this).closest('.product-box-4').find('.product-type').val();

            // Update modal content
            $('.title-name').text(productName);
            $('.modal-product-description').text(productDescription);
            $('.modal-product-image').attr('src', productImage);
            $('.modal-product-brand').text(productBrand);
            if (productType == '1') {
                $('.modal-product-type').text('single product');
            } else {
                $('.modal-product-type').text('variant product');
            }

            // set attr val for future use
            $('.view-button').attr('data-product-slug', productSlug);
            $('.add-cart-button').attr('data-product-id', productId);
            $('.modal-button').data('product-id', productId);
        });

        $('.view-button').on('click', function() {
            // Get the product slug
            var productSlug = $(this).data('product-slug');

            var url = '{{ route('productDetails', ['slug' => ':slug']) }}';
            url = url.replace(':slug', productSlug);
            window.location.href = url;
        });

        $('.add-cart-button').on('click', function() {
            var productId = $(this).parent('.modal-button').data('product-id');
            callAddToCart(productId, 1, 'ADD', 'view-more');
        });
    });
</script>
@endsection
