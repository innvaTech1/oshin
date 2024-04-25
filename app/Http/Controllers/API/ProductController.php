<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Modules\Product\app\Services\ProductService;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function products(Request $request)
    {
        $products = $this->productService->allActiveProducts();
        
        if (count($products) > 0) {
            // dd($products);
            return responseSuccess(ProductResource::collection($products));
        } else {
            return responseFail('Products not found', 404);
        }
    }

    public function featuredProducts(Request $request)
    {
        $products = $this->productService->allActiveProducts()->where('is_featured', 1)->paginate(12);
        if (count($products) > 0) {
            return responseSuccess(ProductResource::collection($products));
        } else {
            return responseFail('Products not found', 404);
        }
    }
    public function bestSellerProducts(Request $request)
    {
        $products = $this->productService->allActiveProducts()->where('is_bestseller', 1)->paginate(12);
        if (count($products) > 0) {
            return responseSuccess(ProductResource::collection($products));
        } else {
            return responseFail('Products not found', 404);
        }
    }
    public function homepageProducts(Request $request)
    {
        $products = $this->productService->allActiveProducts()->where('show_homepage', 1)->paginate(12);
        if (count($products) > 0) {
            return responseSuccess(ProductResource::collection($products));
        } else {
            return responseFail('Products not found', 404);
        }
    }
    public function show(string $slug){
        try {
            $product = $this->productService->getProductBySlug($slug);

            $productResource = new ProductResource($product);
            $data['product'] = $productResource;
            $prodVar = $this->productService->getProductVariants($product);
            $data['variants'] = $prodVar;
            if ($product) {
                return responseSuccess($product);
            } else {
                return responseFail('Product not found', 404);
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return responseFail($ex->getMessage(), 500);
        }
    }
}
