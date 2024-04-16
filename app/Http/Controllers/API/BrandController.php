<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\BrandResource;
use App\Models\Brand;
use App\Services\BrandService;
use Illuminate\Http\Request;

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
        $brands = $this->brandService->getActiveBrands();
        if (count($brands) > 0) {   
            return responseSuccess(BrandResource::collection($brands));
        } else {
            return responseFail('Brands not found', 404);
        }
    }

    // get products by brand

    public function products($slug)
    {
        $brand = Brand::where('slug', $slug)->first();
        $products = $brand->products;

        return response()->json([
            'data' => $products,
            'msg' => 'success'
        ], 200);
    }
}
