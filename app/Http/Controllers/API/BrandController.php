<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    // get all brands

    public function brands(){
        $brands = Brand::all();

        return response()->json([
            'data' => $brands,
            'msg' => 'success'
        ],200);
    }

    // get products by brand

    public function products($slug){
        $brand = Brand::where('slug',$slug)->first();
        $products = $brand->products;

        return response()->json([
            'data' => $products,
            'msg' => 'success'
        ],200);
    }
}
