@extends('frontend.layouts.master')
@section('title', 'Products')
@section('content')
    {{-- <!-- Breadcrumb Section Start -->
 <section class="breadcrumb-section pt-0">
    <div class="container-fluid-lg">
        <div class="row">
            <div class="col-12">
                <div class="breadcrumb-contain">
                    <h2>Shop Left Sidebar</h2>
                    <nav>
                        <ol class="breadcrumb mb-0">
                            <li class="breadcrumb-item">
                                <a href="index.html">
                                    <i class="fa-solid fa-house"></i>
                                </a>
                            </li>
                            <li class="breadcrumb-item active">Shop Left Sidebar</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- Breadcrumb Section End --> --}}

    <!-- Poster Section Start -->
    <section>
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-12">
                    <div class="slider-1 slider-animate product-wrapper no-arrow">
                        <div>
                            <div class="banner-contain-2 hover-effect">
                                <img src="{{ asset('uploads/12.jpg') }}" class="bg-img rounded-3 blur-up lazyload"
                                    alt="">
                                <div class="banner-detail p-center-right position-relative shop-banner ms-auto banner-small">
                                    <div>
                                        <h2>Lorem ipsum dolor sit amet consectetur adipisicing elit. Fuga, odio!</h2>
                                        <h3>Save upto 50%</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="banner-contain-2 hover-effect">
                                <img src="{{ asset('uploads/13.jpg') }}" class="bg-img rounded-3 blur-up lazyload"
                                    alt="">
                                <div
                                    class="banner-detail p-center-right position-relative shop-banner ms-auto banner-small">
                                    <div>
                                        <h2>Healthy, nutritious & Tasty Fruits & Veggies</h2>
                                        <h3>Save upto 50%</h3>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div>
                            <div class="banner-contain-2 hover-effect">
                                <img src="{{ asset('uploads/11.jpg') }}" class="bg-img rounded-3 blur-up lazyload"
                                    alt="">
                                <div
                                    class="banner-detail p-center-right position-relative shop-banner ms-auto banner-small">
                                    <div>
                                        <h2>Healthy, nutritious & Tasty Fruits & Veggies</h2>
                                        <h3>Save upto 50%</h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- Poster Section End -->

    <!-- Shop Section Start -->
    <section class="section-b-space shop-section">
        <div class="container-fluid-lg">
            <div class="row">
                <div class="col-custom-3">
                    <div class="left-box wow fadeInUp">
                        <div class="shop-left-sidebar">
                            <div class="back-button">
                                <h3><i class="fa-solid fa-arrow-left"></i> Back</h3>
                            </div>

                            <div class="filter-category">
                                <div class="filter-title">
                                    <h2>Filters</h2>
                                    <a href="javascript:void(0)">Clear All</a>
                                </div>
                                {{-- <ul>
                                    <li>
                                        <a href="javascript:void(0)">Vegetable</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Fruit</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Fresh</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Milk</a>
                                    </li>
                                    <li>
                                        <a href="javascript:void(0)">Meat</a>
                                    </li>
                                </ul> --}}
                            </div>

                            <div class="accordion custom-accordion" id="accordionExample">
                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingOne">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseOne">
                                            <span>Categories</span>
                                        </button>
                                    </h2>
                                    <div id="collapseOne" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            {{-- <div class="form-floating theme-form-floating-2 search-box">
                                                <input type="search" class="form-control" id="search"
                                                    placeholder="Search ..">
                                                <label for="search">Search</label>
                                            </div> --}}
                                            <ul class="category-list custom-padding custom-height">
                                                @foreach ($categories as $category)
                                                    <li>
                                                        <div
                                                            class="form-check ps-0 m-0 category-list-box category-filter-check">
                                                            <input class="checkbox_animated" type="checkbox" id="category"
                                                                value="{{ $category->id }}">
                                                            <label class="form-check-label" for="category">
                                                                <span class="name">{{ $category->name }}</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>


                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingTwo">
                                        <button class="accordion-button" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseTwo">
                                            <span>Brands</span>
                                        </button>
                                    </h2>
                                    <div id="collapseTwo" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding custom-height">
                                                @foreach ($brands as $brand)
                                                    <li>
                                                        <div
                                                            class="form-check ps-0 m-0 category-list-box brand-filter-check">
                                                            <input class="checkbox_animated" type="checkbox"
                                                                id="{{ $brand->slug }}" value="{{ $brand->id }}">
                                                            <label class="form-check-label" for="{{ $brand->slug }}">
                                                                <span class="name">{{ $brand->name }}</span>
                                                            </label>
                                                        </div>
                                                    </li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                </div>



                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingThree">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseThree">
                                            <span>Price</span>
                                        </button>
                                    </h2>
                                    <div id="collapseThree" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <div class="range-slider">
                                                <input type="text" class="js-range-slider" value="">
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingSix">
                                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                                            data-bs-target="#collapseSix">
                                            <span>Rating</span>
                                        </button>
                                    </h2>
                                    <div id="collapseSix" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding">
                                                @for ($stars = 5; $stars >= 1; $stars--)
                                                    <li>
                                                        <div
                                                            class="form-check ps-0 m-0 category-list-box rating-filter-check">
                                                            <input class="checkbox_animated" type="checkbox"
                                                                id="{{ $stars }}" value="{{ $stars }}">
                                                            <div class="form-check-label">
                                                                <ul class="rating">
                                                                    @for ($i = 1; $i <= 5; $i++)
                                                                        <li>
                                                                            <i data-feather="star"
                                                                                class="{{ $i <= $stars ? 'fill' : '' }}"></i>
                                                                        </li>
                                                                    @endfor
                                                                </ul>
                                                                <span class="text-content">({{ $stars }}
                                                                    Star)</span>
                                                            </div>
                                                        </div>
                                                    </li>
                                                @endfor
                                            </ul>

                                        </div>
                                    </div>
                                </div>

                                <div class="accordion-item">
                                    <h2 class="accordion-header" id="headingFour">
                                        <button class="accordion-button collapsed" type="button"
                                            data-bs-toggle="collapse" data-bs-target="#collapseFour">
                                            <span>Discount</span>
                                        </button>
                                    </h2>
                                    <div id="collapseFour" class="accordion-collapse collapse show">
                                        <div class="accordion-body">
                                            <ul class="category-list custom-padding">
                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox"
                                                            id="flexCheckDefault">
                                                        <label class="form-check-label" for="flexCheckDefault">
                                                            <span class="name">upto 5%</span>
                                                            <span class="number">(06)</span>
                                                        </label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox"
                                                            id="flexCheckDefault1">
                                                        <label class="form-check-label" for="flexCheckDefault1">
                                                            <span class="name">5% - 10%</span>
                                                            <span class="number">(08)</span>
                                                        </label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox"
                                                            id="flexCheckDefault2">
                                                        <label class="form-check-label" for="flexCheckDefault2">
                                                            <span class="name">10% - 15%</span>
                                                            <span class="number">(10)</span>
                                                        </label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox"
                                                            id="flexCheckDefault3">
                                                        <label class="form-check-label" for="flexCheckDefault3">
                                                            <span class="name">15% - 25%</span>
                                                            <span class="number">(14)</span>
                                                        </label>
                                                    </div>
                                                </li>

                                                <li>
                                                    <div class="form-check ps-0 m-0 category-list-box">
                                                        <input class="checkbox_animated" type="checkbox"
                                                            id="flexCheckDefault4">
                                                        <label class="form-check-label" for="flexCheckDefault4">
                                                            <span class="name">More than 25%</span>
                                                            <span class="number">(13)</span>
                                                        </label>
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

                <div class="col-custom-">
                    <div class="show-button">
                        <div class="filter-button-group mt-0">
                            <div class="filter-button d-inline-block d-lg-none">
                                <a><i class="fa-solid fa-filter"></i> Filter Menu</a>
                            </div>
                        </div>

                        <div class="top-filter-menu">
                            <div class="category-dropdown">
                                <h5 class="text-content">Sort By :</h5>
                                <div class="dropdown">
                                    <button class="dropdown-toggle" type="button" id="dropdownMenuButton1"
                                        data-bs-toggle="dropdown">
                                        <span>Most Popular</span> <i class="fa-solid fa-angle-down"></i>
                                    </button>
                                    <ul class="dropdown-menu">
                                        <li>
                                            <a class="dropdown-item" id="pop"
                                                href="javascript:void(0)">Popularity</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="low" href="javascript:void(0)">Low - High
                                                Price</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="high" href="javascript:void(0)">High - Low
                                                Price</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="rating" href="javascript:void(0)">Average
                                                Rating</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="aToz" href="javascript:void(0)">A - Z
                                                Order</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="zToa" href="javascript:void(0)">Z - A
                                                Order</a>
                                        </li>
                                        <li>
                                            <a class="dropdown-item" id="off" href="javascript:void(0)">% Off -
                                                Hight To
                                                Low</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>

                            <div class="grid-option d-none d-md-block">
                                <ul>
                                    <li class="three-grid">
                                        <a href="javascript:void(0)">
                                            <img src="../assets/svg/grid-3.svg" class="blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                    <li class="grid-btn d-xxl-inline-block d-none active">
                                        <a href="javascript:void(0)">
                                            <img src="../assets/svg/grid-4.svg"
                                                class="blur-up lazyload d-lg-inline-block d-none" alt="">
                                            <img src="../assets/svg/grid.svg"
                                                class="blur-up lazyload img-fluid d-lg-none d-inline-block"
                                                alt="">
                                        </a>
                                    </li>
                                    <li class="list-btn">
                                        <a href="javascript:void(0)">
                                            <img src="../assets/svg/list.svg" class="blur-up lazyload" alt="">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    @include('frontend.partials.product-category-partial', [
                        'products' => $products,
                    ])



                </div>
            </div>
        </div>
    </section>
    <!-- Shop Section End -->
@endsection
@section('scripts')
    <!-- sidebar open js -->
    <script src="{{ asset('assets/js/filter-sidebar.js') }}"></script>
    <!-- Quantity Js -->
    <script src="{{ asset('assets/js/quantity-2.js') }}"></script>
    <!-- Price Range Js -->
    <script src="{{ asset('assets/js/ion.rangeSlider.min.js') }}"></script>

    <script>
        function getQueryParams() {
            var queryString = window.location.search.substr(1); // Remove the leading '?'
            return queryString;
        }

        function updateCheckboxes() {
            var queryParams = getQueryParams();
            var params = new URLSearchParams(queryParams);

            // Update brand checkboxes
            var brandValues = params.getAll('brand');
            $('.brand-filter-check input[type="checkbox"]').prop('checked', false); // Uncheck all checkboxes first
            brandValues.forEach(function(value) {
                $('.brand-filter-check input[type="checkbox"][value="' + value + '"]').prop('checked', true);
            });

            // Update category checkboxes
            var categoryValues = params.getAll('category');
            $('.category-filter-check input[type="checkbox"]').prop('checked', false); // Uncheck all checkboxes first
            categoryValues.forEach(function(value) {
                $('.category-filter-check input[type="checkbox"][value="' + value + '"]').prop('checked', true);
            });

            // Update rating checkboxes
            var ratingValues = params.getAll('rating');
            $('.rating-filter-check input[type="checkbox"]').prop('checked', false); // Uncheck all checkboxes first
            ratingValues.forEach(function(value) {
                $('.rating-filter-check input[type="checkbox"][value="' + value + '"]').prop('checked', true);
            });
        }
    </script>

    <script>
        $(document).ready(function() {
            // Perform AJAX request for manually entered filter query parameters
            var queryString = getQueryParams();
            if (queryString) {
                $.ajax({
                    type: "GET",
                    url: "/products/filter",
                    data: queryString,
                    success: function(response) {
                        updateCheckboxes();
                        $('#product-filter-container').empty();
                        $('#product-filter-container').html(response);
                    },
                    error: function(error) {
                        console.log(error);
                    }
                });
            }
            // ADD TO WISHLIST
            $(document).on('click', '.btn-wishlist', function(e) {
                e.preventDefault();

                // Get the product ID from the data-product-id attribute
                var productId = $(this).data('product-id');
                var icon = $(this).find('.fa-heart');
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
                                'font-weight': '700'
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
            $(document).on('click', '.quick-view-btn', function() {
                var productId = $(this).closest('.product-box-3').find('.product-id').val();
                var productSlug = $(this).closest('.product-box-3').find('.product-slug').val();
                var productName = $(this).closest('.product-box-3').find('.name').text();
                var productImage = $(this).closest('.product-box-3').find('.img-fluid').attr('src');
                var productDescription = $(this).closest('.product-box-3').find('.product-description')
                    .val();
                var productBrand = $(this).closest('.product-box-3').find('.product-brand').val();
                var productType = $(this).closest('.product-box-3').find('.product-type').val();

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

            // Filter change handler for both brands and categories
            $('.brand-filter-check input[type="checkbox"], .category-filter-check input[type="checkbox"],.rating-filter-check input[type="checkbox"]')
                .change(
                    function() {
                        var brands = [];
                        $('.brand-filter-check input[type="checkbox"]:checked').each(function() {
                            brands.push($(this).val());
                        });

                        var categories = [];
                        $('.category-filter-check input[type="checkbox"]:checked').each(function() {
                            categories.push($(this).val());
                        });

                        var ratings = [];
                        $('.rating-filter-check input[type="checkbox"]:checked').each(function() {
                            ratings.push($(this).val());
                        });

                        // Construct the query string
                        var queryString = '';
                        if (brands.length > 0) {
                            queryString += 'brand=' + brands.join(',');
                        }
                        if (categories.length > 0) {
                            queryString += '&category=' + categories.join(',');
                        }
                        if (ratings.length > 0) {
                            queryString += '&rating=' + ratings.join(',');
                        }

                        // Update URL without reloading the page
                        var newUrl = window.location.pathname + '?' + queryString;
                        history.pushState(null, '', newUrl);

                        // Perform AJAX request
                        $.ajax({
                            type: "GET",
                            url: "/products/filter",
                            data: queryString,
                            success: function(response) {
                                $('#product-filter-container').empty();
                                $('#product-filter-container').html(response);
                            },
                            error: function(error) {
                                console.log(error);
                            }
                        });
                    });
        }); //end document
    </script>
@endsection
