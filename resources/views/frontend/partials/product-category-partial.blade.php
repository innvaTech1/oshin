<div id="product-filter-container">
    <div class="row g-sm-4 g-3 row-cols-xxl-4 row-cols-xl-3 row-cols-lg-2 row-cols-md-3 row-cols-2 product-list-section">
        @foreach ($products as $product)
            <div>
                <div class="product-box-3 h-100 wow fadeInUp">
                    <div class="product-header">
                        <div class="product-image">
                            <a href="{{ route('productDetails', $product->slug) }}">
                                <img src="{{ asset($product->thumbnail_image_source) }}" style="height: auto"
                                    class="img-fluid blur-up lazyload" alt="{{ $product->slug }}">
                            </a>

                            {{-- quicek view details starts --}}
                            <input type="hidden" class="product-id" value="{{ $product->id }}">
                            <input type="hidden" class="product-description" value="{{ $product->description }}">
                            <input type="hidden" class="product-brand" value="{{ $product->brand->name }}">
                            <input type="hidden" class="product-type" value="{{ $product->product_type }}">
                            <input type="hidden" class="product-slug" value="{{ $product->slug }}">
                            {{-- quicek view details end --}}

                            <ul class="product-option">
                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="View">
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#view"
                                        class="quick-view-btn" data-product-id={{ $product->id }}>
                                        <i class="fa-regular fa-eye"></i>
                                    </a>
                                </li>

                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Compare">
                                    <a href="javascript:void(0)" data-product-id={{ $product->id }}>
                                        <i class="fa-solid fa-arrows-rotate"></i>
                                    </a>
                                </li>

                                <li data-bs-toggle="tooltip" data-bs-placement="top" title="Wishlist">
                                    <a href="javascript:void(0)" class="notifi-wishlist btn-wishlist"
                                        data-product-id={{ $product->id }}>
                                        <i class="fa-regular fa-heart"
                                            @if ($product->wishlists && !$product->wishlists->isEmpty()) style="color: red; font-weight:700" @endif></i>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="product-footer">
                        <div class="product-detail">
                            <span class="span-name">{{ $product->brand->name }}</span>
                            <a href="{{ route('productDetails', $product->slug) }}">
                                <h5 class="name">{{ $product->product_name }}</h5>
                            </a>
                            <p class="text-content mt-1 mb-2 product-content">
                                {{ $product->description }}
                            </p>
                            <div class="product-rating mt-2">
                                <ul class="rating">
                                    @for ($i = 1; $i <= 5; $i++)
                                        @if ($i <= $product->avg_rating)
                                            <li>
                                                <i class="fa-regular fa-star" style="color:#ffb321;font-weight:700"></i>
                                            </li>
                                        @else
                                            <i class="fa-regular fa-star" style="color:#ffb321"></i>
                                        @endif
                                    @endfor
                                </ul>
                            </div>
                            <h5 class="price"><span class="theme-color">$08.02</span> <del>$15.15</del>
                            </h5>
                            <div class="add-to-cart-box bg-white mt-2">
                                <button class="btn btn-add-cart addcart-button"
                                    data-product-id="{{ $product->id }}">Add
                                    <span class="add-icon bg-light-gray">
                                        <i class="fa-solid fa-plus"></i>
                                    </span>
                                </button>
                                <div data-removed-from-cart="{{ !empty($product->cart) && isset($product->cart[0]['id']) ? $product->cart[0]['id'] : '' }}"
                                    class="cart_qty qty-box @if (
                                        (!empty($product->cart) && isset($product->cart[0]['quantity'])) ||
                                            (session()->has('cart') && isset(session('cart')[$product->id]))) open @endif">
                                    <div class="input-group bg-white">
                                        <button type="button" class="qty-left-minus bg-gray" data-type="minus"
                                            data-field="" data-product-id="{{ $product->id }}">
                                            <i class="fa fa-minus"></i>
                                        </button>
                                        <input class="form-control input-number qty-input" type="text"
                                            name="quantity"
                                            value="{{ !empty($product->cart) && isset($product->cart[0]['quantity']) ? $product->cart[0]['quantity'] : (session()->has('cart') && isset(session('cart')[$product->id]['quantity']) ? session('cart')[$product->id]['quantity'] : '') }}">
                                        <button type="button" class="qty-right-plus bg-gray" data-type="plus"
                                            data-field="" data-product-id="{{ $product->id }}">
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

    <div class="mt-5">
        @if ($products->isEmpty())
            <div class="alert alert-warning text-center" role="alert">
                No Products available!
            </div>
        @endif
    </div>

    @if (!$products->isEmpty())
        <nav class="custom-pagination">
            <ul class="pagination justify-content-center">
                <li class="page-item {{ $products->currentPage() == 1 ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $products->previousPageUrl() }}" tabindex="-1">
                        <i class="fa-solid fa-angles-left"></i>
                    </a>
                </li>
                @foreach ($products->getUrlRange(1, $products->lastPage()) as $page => $url)
                    <li class="page-item {{ $page == $products->currentPage() ? 'active' : '' }}">
                        <a class="page-link" href="{{ $url }}">{{ $page }}</a>
                    </li>
                @endforeach
                <li class="page-item {{ $products->currentPage() == $products->lastPage() ? 'disabled' : '' }}">
                    <a class="page-link" href="{{ $products->nextPageUrl() }}">
                        <i class="fa-solid fa-angles-right"></i>
                    </a>
                </li>
            </ul>
        </nav>
    @endif
</div>
