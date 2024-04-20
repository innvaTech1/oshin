<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Product\app\Models\Product;

class ProductController extends Controller
{

    /**
     * Display the specified resource.
     */
    public function show(string $slug)
    {
        $product = Product::with(['brand', 'images'])
            ->select('id', 'product_name', 'slug', 'user_id', 'brand_id', 'thumbnail_image_source', 'model_number', 'shipping_type', 'shipping_cost', 'discount_type', 'discount', 'tax_type', 'tax', 'description', 'specification', 'min_sell_price', 'max_sell_price', 'total_sale', 'max_order_qty', 'meta_title', 'meta_description', 'meta_image', 'is_approved', 'status', 'avg_rating')
            ->where('is_approved', true)
            ->where('slug', $slug)
            ->first();

        if (Auth::check()) {
            $is_wishlisted = Wishlist::where('product_id', $product->id)->where('user_id', Auth::id())->exists();
            $in_cart = Cart::where('user_id', Auth::id())->where('product_id', $product->id)->exists();
        } else {
            $is_wishlisted = false;
            $in_cart = false;
        }

        return view('frontend.productDetails', [
            'product' => $product,
            'is_wishlisted' => $is_wishlisted,
            'in_cart' => $in_cart
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }
}
