<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;

use Modules\Product\app\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Modules\Product\app\Models\Category;

class HomeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::select('id', 'name', 'slug', 'image')->get();

        if (Auth::check() == true) {
            $products = Product::with(['brand', 'wishlists' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
                ->select('id', 'product_name', 'slug', 'description', 'brand_id', 'thumbnail_image_source', 'is_approved', 'status', 'avg_rating')
                ->where('is_approved', true)
                ->whereNotIn('id', function ($query) {
                    $query->select('product_id')
                        ->from('carts')
                        ->where('user_id', Auth::id());
                })
                ->inRandomOrder()
                ->take(8)
                ->get();

            $top_products = Product::with(['brand', 'wishlists' => function ($query) {
                $query->where('user_id', Auth::id());
            }])
                ->select('id', 'product_name', 'slug', 'description', 'brand_id', 'thumbnail_image_source', 'is_approved', 'status', 'avg_rating', 'total_sale')
                ->where('is_approved', true)
                ->whereNotIn('id', function ($query) {
                    $query->select('product_id')
                        ->from('carts')
                        ->where('user_id', Auth::id());
                })
                ->orderBy('total_sale', 'desc')
                ->take(20)
                ->get();
        } else {
            $products = Product::with('brand')
                ->where('is_approved', true)
                ->select('id', 'product_name', 'slug', 'description', 'brand_id', 'thumbnail_image_source', 'is_approved', 'status', 'avg_rating')
                ->inRandomOrder()
                ->take(8)
                ->get()->each(function ($product) {
                    $product->setRelation('wishlists', null);
                });

            // Set wishlists relationship to null explicitly
            $top_products = Product::where('is_approved', true)
                ->select('id', 'product_name', 'slug', 'description', 'brand_id', 'thumbnail_image_source', 'is_approved', 'status', 'avg_rating', 'total_sale')
                ->orderBy('total_sale', 'desc')
                ->take(20)
                ->get()
                ->each(function ($product) {
                    $product->setRelation('wishlists', null);
                });
        }
        return view('frontend.home', [
            'products' => $products,
            'top_products' => $top_products,
            'categories' => $categories,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
