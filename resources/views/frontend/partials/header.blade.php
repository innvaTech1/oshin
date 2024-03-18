<body class="bg-effect">
    <!-- Loader Start -->
    <div class="fullpage-loader">
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
        <span></span>
    </div>
    <!-- Loader End -->

    <!-- Header Start -->
    <header class="header-2">
        <div class="header-notification theme-bg-color overflow-hidden py-2">
            <div class="notification-slider">
                <div>
                    <div class="timer-notification text-center">
                        <h6><strong class="me-1">Welcome to {{ env('APP_NAME') }}!</strong>Wrap new offers/gift
                            every single day on Weekends.<strong class="ms-1">New Coupon Code: new024
                            </strong>
                        </h6>
                    </div>
                </div>

                <div>
                    <div class="timer-notification text-center">
                        <h6>Something you love is now on sale!<a href="javascript:void(0)" class="text-white">Buy
                                Now
                                !</a>
                        </h6>
                    </div>
                </div>
            </div>
            <button class="btn close-notification"><span>Close</span> <i class="fas fa-times"></i></button>
        </div>
        <div class="top-nav top-header sticky-header sticky-header-3">
            <div class="container-fluid-lg">
                <div class="row">
                    <div class="col-12">
                        <div class="navbar-top">
                            <button class="navbar-toggler d-xl-none d-block p-0 me-3" type="button"
                                data-bs-toggle="offcanvas" data-bs-target="#primaryMenu">
                                <span class="navbar-toggler-icon">
                                    <i class="iconly-Category icli theme-color"></i>
                                </span>
                            </button>
                            <a href="{{ route('home') }}" class="web-logo nav-logo">
                                <img src="{{ asset('assets/images/logo/3.png') }}" class="img-fluid blur-up lazyload"
                                    alt="logo">
                            </a>

                            <div class="search-full">
                                <div class="input-group">
                                    <span class="input-group-text">
                                        <i data-feather="search" class="font-light"></i>
                                    </span>
                                    <input type="text" class="form-control search-type" placeholder="Search here..">
                                    <span class="input-group-text close-search">
                                        <i data-feather="x" class="font-light"></i>
                                    </span>
                                </div>
                            </div>

                            <div class="middle-box">
                                <div class="center-box">
                                    <div class="searchbar-box order-xl-1 d-none d-xl-block">
                                        <input type="search" class="form-control" id="exampleFormControlInput1"
                                            placeholder="search for product, delivered to your door...">
                                        <button class="btn search-button">
                                            <i class="iconly-Search icli"></i>
                                        </button>
                                    </div>
                                    <div class="location-box-2">
                                        <button class="btn location-button" data-bs-toggle="modal"
                                            data-bs-target="#locationModal">
                                            <i class="iconly-Location icli"></i>
                                            <span class="locat-name">Your Location</span>
                                            <i class="fa-solid fa-angle-down down-arrow"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                            <div class="rightside-menu">
                                <div class="dropdown-dollar">
                                    <div class="dropdown">
                                        <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                            data-bs-toggle="dropdown">
                                            <span>Language</span> <i class="fa-solid fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a id="eng" class="dropdown-item"
                                                    href="javascript:void(0)">English</a>
                                            </li>
                                            <li>
                                                <a id="hin" class="dropdown-item"
                                                    href="javascript:void(0)">Hindi</a>
                                            </li>
                                            <li>
                                                <a id="guj" class="dropdown-item"
                                                    href="javascript:void(0)">Gujarati</a>
                                            </li>
                                            <li>
                                                <a id="arb" class="dropdown-item"
                                                    href="javascript:void(0)">Arabic</a>
                                            </li>
                                            <li>
                                                <a id="rus" class="dropdown-item"
                                                    href="javascript:void(0)">Russia</a>
                                            </li>
                                            <li>
                                                <a class="dropdown-item" href="javascript:void(0)">Chinese</a>
                                            </li>
                                        </ul>
                                    </div>

                                    <div class="dropdown">
                                        <button class="dropdown-toggle m-0" type="button" id="dropdownMenuButton2"
                                            data-bs-toggle="dropdown">
                                            <span>Dollar</span> <i class="fa-solid fa-angle-down"></i>
                                        </button>
                                        <ul class="dropdown-menu">
                                            <li>
                                                <a id="usd" class="dropdown-item"
                                                    href="javascript:void(0)">USD</a>
                                            </li>
                                            <li>
                                                <a id="inr" class="dropdown-item"
                                                    href="javascript:void(0)">INR</a>
                                            </li>
                                            <li>
                                                <a id="eur" class="dropdown-item"
                                                    href="javascript:void(0)">EUR</a>
                                            </li>
                                            <li>
                                                <a id="aud" class="dropdown-item"
                                                    href="javascript:void(0)">AUD</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                <div class="option-list">
                                    <ul>
                                        <li>
                                            <a href="{{ route('compare') }}" class="header-icon">
                                                <small class="badge-number compare-count">
                                                    {{ count(session('compare') ?? []) }}
                                                </small>
                                                <i class="iconly-Swap icli"></i>
                                            </a>
                                        </li>

                                        <li class="d-none">
                                        </li>

                                        <li>
                                            <a href="javascript:void(0)" class="header-icon search-box search-icon">
                                                <i class="iconly-Search icli"></i>
                                            </a>
                                        </li>

                                        <li class="onhover-dropdown">
                                            @auth
                                                <a href="{{ route('wishlist') }}" class="header-icon swap-icon">
                                                    <i class="iconly-Heart icli"></i>
                                                </a>
                                            @else
                                                <a href="{{ route('login') }}" class="header-icon swap-icon">
                                                    <i class="iconly-Heart icli"></i>
                                                </a>
                                            @endauth
                                        </li>


                                        <li class="onhover-dropdown">
                                            <a href="{{ route('cart.index') }}" class="header-icon bag-icon">
                                                <small id="cart-count" class="badge-number">0</small>
                                                <i class="iconly-Bag-2 icli"></i>
                                            </a>
                                            <div class="onhover-div" style="max-height: 400px; overflow:auto;">
                                                <ul class="cart-list">
                                                </ul>

                                                {{-- <div id="cart-total-price" class="price-box">
                                                    <h5>Price :</h5>
                                                    <h4 class="theme-color fw-bold">$106.58</h4>
                                                </div> --}}

                                                <div class="button-group">
                                                    <a href="{{ route('cart.index') }}"
                                                        class="btn btn-sm cart-button">View Cart</a>
                                                    <a id="cart-checkout" href="{{ route('checkout') }}"
                                                        class="btn btn-sm cart-button theme-bg-color
                                                    text-white">Checkout</a>
                                                </div>
                                            </div>
                                        </li>
                                        <li class="onhover-dropdown">
                                            <button class="header-icon bag-icon">
                                                <i class="iconly-Profile icli"></i>
                                            </button>
                                            <div class="onhover-div onhover-div-login">
                                                {{-- auth --}}
                                                @auth
                                                    <ul class="user-box-name">
                                                        <li class="product-box-contain">
                                                            <i></i>
                                                            <a href="{{ route('userDashboard') }}">Dashboard</a>
                                                        </li>
                                                        <li class="product-box-contain">
                                                            <i></i>
                                                            <a href="javascript:void(0)" id="logout-btn">Log Out</a>
                                                        </li>
                                                    </ul>
                                                    {{-- not auth --}}
                                                @else
                                                    <ul class="user-box-name">
                                                        <li class="product-box-contain">
                                                            <i></i>
                                                            <a href="{{ route('login') }}">Log In</a>
                                                        </li>

                                                        <li class="product-box-contain">
                                                            <a href="{{ route('register') }}">Register</a>
                                                        </li>
                                                    </ul>
                                                @endauth
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
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="main-nav">
                        <div class="header-nav-left">
                            <button class="dropdown-category dropdown-category-2">
                                <i class="iconly-Category icli"></i>
                                <span>All Categories</span>
                            </button>

                            <div class="category-dropdown">
                                <div class="category-title">
                                    <h5>Categories</h5>
                                    <button type="button" class="btn p-0 close-button text-content">
                                        <i class="fa-solid fa-xmark"></i>
                                    </button>
                                </div>

                                <ul class="category-list">
                                    @foreach ($categories as $category)
                                        <li class="onhover-category-list">
                                            <a href="{{ route('products', ['category' => $category->id]) }}"
                                                class="category-name">
                                                <h6>{{ $category->name }}</h6>
                                                <i class="fa-solid fa-angle-right"></i>
                                            </a>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>

                        <div class="main-nav navbar navbar-expand-xl navbar-light navbar-sticky">
                            <div class="offcanvas offcanvas-collapse order-xl-2" id="primaryMenu">
                                <div class="offcanvas-header navbar-shadow">
                                    <h5>Menu</h5>
                                    <button class="btn-close lead" type="button"
                                        data-bs-dismiss="offcanvas"></button>
                                </div>
                                <div class="offcanvas-body">
                                    <ul class="navbar-nav">
                                        <li class="nav-item dropdown dropdown-mega">
                                            <a class="nav-link dropdown-toggle ps-xl-2 ps-0" href="javascript:void(0)"
                                                data-bs-toggle="dropdown">Home</a>

                                            <!-- <div
                                                class="dropdown-menu dropdown-menu-2 dropdown-image dropdown-menu-left">
                                                <div class="dropdown-column">
                                                    <a class="dropdown-item" href="index.html">
                                                        <img src="../assets/images/theme/1.jpg" class="img-fluid"
                                                            alt="">
                                                        <span>Kartshop</span>
                                                    </a>

                                                    <a class="dropdown-item" href="index-2.html">
                                                        <img src="../assets/images/theme/2.jpg" class="img-fluid"
                                                            alt="">
                                                        <span>Sweetshop</span>
                                                    </a>

                                                    <a class="dropdown-item" href="index-3.html">
                                                        <img src="../assets/images/theme/3.jpg" class="img-fluid"
                                                            alt="">
                                                        <span>Organic</span>
                                                    </a>

                                                    <a class="dropdown-item" href="index-4.html">
                                                        <img src="../assets/images/theme/4.jpg" class="img-fluid"
                                                            alt="">
                                                        <span>Supershop</span>
                                                    </a>

                                                    <a class="dropdown-item" href="index-5.html">
                                                        <img src="../assets/images/theme/5.jpg" class="img-fluid"
                                                            alt="">
                                                        <span>Slicktech</span>
                                                    </a>
                                                </div>
                                            </div> -->

                                            {{-- <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="index.html">Kartshop</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="index-2.html">Sweetshop</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="index-3.html">Organic</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="index-4.html">Supershop</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="index-5.html">Classic shop</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="index-6.html">Furniture</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="index-7.html">Search Oriented</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="index-8.html">Category Focus</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="index-9.html">Fashion</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="index-10.html">Book</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="index-11.html">Digital</a>
                                                </li>
                                            </ul> --}}
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                data-bs-toggle="dropdown">Shop</a>

                                            {{-- <ul class="dropdown-menu">
                                                <li>
                                                    <a class="dropdown-item" href="shop-category-slider.html">Shop
                                                        Category Slider</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="shop-category.html">Shop
                                                        Category Sidebar</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="shop-banner.html">Shop Banner</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="javascript:void(0)">Shop Left
                                                        Sidebar</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="shop-list.html">Shop List</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="shop-right-sidebar.html">Shop
                                                        Right Sidebar</a>
                                                </li>
                                                <li>
                                                    <a class="dropdown-item" href="shop-top-filter.html">Shop Top
                                                        Filter</a>
                                                </li>
                                            </ul> --}}
                                        </li>

                                        <li class="nav-item dropdown">
                                            <a class="nav-link dropdown-toggle" href="javascript:void(0)"
                                                data-bs-toggle="dropdown">Product</a>

                                            {{-- <div class="dropdown-menu dropdown-menu-3 dropdown-menu-2">
                                                <div class="row">
                                                    <div class="col-xl-3">
                                                        <div class="dropdown-column m-0">
                                                            <h5 class="dropdown-header">
                                                                Product Pages </h5>
                                                            <a class="dropdown-item"
                                                                href="product-left-thumbnail.html">Product
                                                                Thumbnail</a>
                                                            <a class="dropdown-item"
                                                                href="product-4-image.html">Product
                                                                Images</a>
                                                            <a class="dropdown-item"
                                                                href="product-slider.html">Product
                                                                Slider</a>
                                                            <a class="dropdown-item"
                                                                href="product-sticky.html">Product
                                                                Sticky</a>
                                                            <a class="dropdown-item"
                                                                href="product-accordion.html">Product Accordion</a>
                                                            <a class="dropdown-item"
                                                                href="product-circle.html">Product
                                                                Tab</a>
                                                            <a class="dropdown-item"
                                                                href="product-digital.html">Product
                                                                Tab</a>

                                                            <h5 class="custom-mt dropdown-header">Product Features
                                                            </h5>
                                                            <a class="dropdown-item" href="product-circle.html">Bundle
                                                                (Cross Sale)</a>
                                                            <a class="dropdown-item"
                                                                href="product-left-thumbnail.html">Hot Stock
                                                                Progress <label class="menu-label">New</label>
                                                            </a>
                                                            <a class="dropdown-item" href="product-sold-out.html">SOLD
                                                                OUT</a>
                                                            <a class="dropdown-item" href="product-circle.html">
                                                                Sale Countdown</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3">
                                                        <div class="dropdown-column m-0">
                                                            <h5 class="dropdown-header">
                                                                Product Variants Style </h5>
                                                            <a class="dropdown-item"
                                                                href="product-rectangle.html">Variant Rectangle</a>
                                                            <a class="dropdown-item"
                                                                href="product-circle.html">Variant
                                                                Circle <label class="menu-label">New</label></a>
                                                            <a class="dropdown-item"
                                                                href="product-color-image.html">Variant Image
                                                                Swatch</a>
                                                            <a class="dropdown-item" href="product-color.html">Variant
                                                                Color</a>
                                                            <a class="dropdown-item" href="product-radio.html">Variant
                                                                Radio Button</a>
                                                            <a class="dropdown-item"
                                                                href="product-dropdown.html">Variant Dropdown</a>
                                                            <h5 class="custom-mt dropdown-header">Product Features
                                                            </h5>
                                                            <a class="dropdown-item"
                                                                href="product-left-thumbnail.html">Sticky
                                                                Checkout</a>
                                                            <a class="dropdown-item"
                                                                href="product-dynamic.html">Dynamic
                                                                Checkout</a>
                                                            <a class="dropdown-item" href="product-sticky.html">Secure
                                                                Checkout</a>
                                                            <a class="dropdown-item" href="product-bundle.html">Active
                                                                Product view</a>
                                                            <a class="dropdown-item" href="product-bundle.html">
                                                                Active
                                                                Last Orders
                                                            </a>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3">
                                                        <div class="dropdown-column m-0">
                                                            <h5 class="dropdown-header">
                                                                Product Features </h5>
                                                            <a class="dropdown-item" href="product-image.html">Product
                                                                Simple</a>
                                                            <a class="dropdown-item" href="product-rectangle.html">
                                                                Product Classified <label
                                                                    class="menu-label">New</label>
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="product-size-chart.html">Size
                                                                Chart <label class="menu-label">New</label></a>
                                                            <a class="dropdown-item"
                                                                href="product-size-chart.html">Delivery &
                                                                Return</a>
                                                            <a class="dropdown-item"
                                                                href="product-size-chart.html">Product Review</a>
                                                            <a class="dropdown-item" href="product-expert.html">Ask
                                                                an Expert</a>
                                                            <h5 class="custom-mt dropdown-header">Product Features
                                                            </h5>
                                                            <a class="dropdown-item"
                                                                href="product-bottom-thumbnail.html">Product
                                                                Tags</a>
                                                            <a class="dropdown-item" href="product-image.html">Store
                                                                Information</a>
                                                            <a class="dropdown-item" href="product-image.html">Social
                                                                Share <label
                                                                    class="menu-label warning-label">Hot</label>
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="product-left-thumbnail.html">Related Products
                                                                <label class="menu-label warning-label">Hot</label>
                                                            </a>
                                                            <a class="dropdown-item"
                                                                href="product-right-thumbnail.html">Wishlist &
                                                                Compare</a>
                                                        </div>
                                                    </div>
                                                    <div class="col-xl-3 d-xl-block d-none">
                                                        <div class="dropdown-column m-0">
                                                            <div class="menu-img-banner">
                                                                <a class="text-title" href="product-circle.html">
                                                                    <img src="../assets/images/mega-menu.png"
                                                                        alt="banner">
                                                                </a>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div> --}}
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>

                        <div class="right-nav">
                            {{-- <div class="nav-number">
                                <img src="../assets/images/icon/music.png" class="img-fluid blur-up lazyload"
                                    alt="">
                                <span>(123) 456 7890</span>
                            </div> --}}
                            <a href="javascript:void(0)" class="btn theme-bg-color ms-3 fire-button"
                                data-bs-toggle="modal" data-bs-target="#deal-box">
                                <div class="fire">
                                    <img src="../assets/images/icon/hot-sale.png" class="img-fluid" alt="">
                                </div>
                                <span>Hot Deals</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- Header End -->

    <!-- mobile fix menu start -->
    <div class="mobile-menu d-md-none d-block mobile-cart">
        <ul>
            <li class="{{ Route::currentRouteName() === 'home' ? 'active' : '' }}">
                <a href="{{ route('home') }}">
                    <i class="iconly-Home icli"></i>
                    <span>Home</span>
                </a>
            </li>

            <li class="mobile-category">
                <a href="javascript:void(0)">
                    <i class="iconly-Category icli js-link"></i>
                    <span>Category</span>
                </a>
            </li>

            <li class="{{ Route::currentRouteName() === 'userDashboard' ? 'active' : '' }}">
                <a href="{{ route('userDashboard') }}" class="user-box">
                    <i class="iconly-Profile icli"></i>
                    <span>User</span>
                </a>
            </li>

            <li class="{{ Route::currentRouteName() === 'wishlist' ? 'active' : '' }}">
                <a href="{{ route('wishlist') }}" class="notifi-wishlist">
                    <i class="iconly-Heart icli"></i>
                    <span>My Wish</span>
                </a>
            </li>

            <li class="{{ Route::currentRouteName() === 'cart.index' ? 'active' : '' }}">
                <a href="{{ route('cart.index') }}">
                    <i class="iconly-Bag-2 icli fly-cate"></i>
                    <span>Cart</span>
                </a>
            </li>
        </ul>
    </div>
    <!-- mobile fix menu end -->
