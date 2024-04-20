<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use Modules\Product\app\Models\Category;
use Modules\Product\app\Models\Product;
use Modules\Product\app\Models\ProductBrand;

class ProductCategoryController extends Controller
{
    private $totalItemsInAPage = 5;

    private function filter($brandsquery, $categoriesquery, $ratingsquery)
    {
        $query = Product::with('brand', 'cart', 'wishlists')
            ->select('id', 'product_name', 'slug', 'description', 'brand_id', 'thumbnail_image_source', 'is_approved', 'status', 'avg_rating')
            ->where('status', true);

        if ($brandsquery) {
            $brandsArray = explode(',', $brandsquery);
            $query->whereIn('brand_id', $brandsArray);
        }

        if ($categoriesquery) {
            $categoriesArray = explode(',', $categoriesquery);
            $query->whereHas('categories', function ($query) use ($categoriesArray) {
                $query->whereIn('category_id', $categoriesArray);
            });
        }

        if ($ratingsquery) {
            $ratingsArray = explode(',', $ratingsquery);
            $query->where(function ($query) use ($ratingsArray) {
                $query->whereIn(DB::raw('ROUND(avg_rating)'), $ratingsArray);
            });
        }

        $products = $query->inRandomOrder()->paginate($this->totalItemsInAPage);
        $returnHTML = view('frontend.partials.product-category-partial', compact('products'))->render();
        return response($returnHTML, 200);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $categories = Category::select('id', 'name', 'status')->where('status', true)->get();
        $brands = ProductBrand::select('id', 'name', 'slug', 'status')->where('status', true)->get();

        $products = Product::with('brand', 'cart', 'wishlists')
            ->select('id', 'product_name', 'slug', 'description', 'brand_id', 'image', 'is_approved', 'status', 'avg_rating')
            ->where('is_approved', true)
            // ->inRandomOrder()
            ->paginate($this->totalItemsInAPage);

        return view('frontend.category', [
            'products' => $products,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }
    public function filterProducts()
    {
        $brandsquery = request()->query('brand');
        $categoriesquery = request()->query('category');
        $ratingsquery = request()->query('rating');

        if ($brandsquery || $categoriesquery || $ratingsquery) {
            return $this->filter($brandsquery, $categoriesquery, $ratingsquery);
        } else {
            $query = Product::with('brand', 'cart', 'wishlists')
                ->select('id', 'product_name', 'slug', 'description', 'brand_id', 'thumbnail_image_source', 'is_approved', 'status', 'avg_rating')
                ->where('status', true);
            $products = $query->inRandomOrder()->paginate($this->totalItemsInAPage);
            $returnHTML = view('frontend.partials.product-category-partial', compact('products'))->render();
            return response($returnHTML, 200);
        }
    }
}
