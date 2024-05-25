<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Http\Resources\ProductResource;
use Illuminate\Support\Facades\Cache;
use Modules\Product\app\Services\BrandService;

class BrandController extends Controller
{
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }
    // get all brands

    public function brands()
    {
        // check if in cache
        if (Cache::has('brands')) {
            $brands = Cache::get('brands');
            return responseSuccess(BrandResource::collection($brands));
        } else {
            $brands = $this->brandService->getActiveBrands();
            if (count($brands) > 0) {
                Cache::rememberForever('brands', $brands, 60);
                return responseSuccess(BrandResource::collection($brands));
            } else {
                return responseFail('Brands not found', 404);
            }
        }
    }

    public function show(string $slug)
    {
        $brand = $this->brandService->findBySlug($slug);
        if ($brand) {
            return responseSuccess($brand);
        } else {
            return responseFail('Brand not found', 404);
        }
    }

    // get products by brand

    public function products(string $slug)
    {
        $products = $this->brandService->getProductByBrand($slug);
        if (count($products) > 0) {
            return responseSuccess(ProductResource::collection($products));
        } else {
            return responseFail('Products not found', 404);
        }
    }
}
