<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use App\Services\ProductService;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function products(Request $request)
    {
        $products = $this->productService->allActiveProducts()->paginate(10);
        if (count($products) > 0) {
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
        $product = $this->productService->findBySlug($slug);
        if ($product) {
            return responseSuccess($product);
        } else {
            return responseFail('Product not found', 404);
        }
    }
}
