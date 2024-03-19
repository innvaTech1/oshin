<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    public function index(){
        $categories = Category::with('children')->whereNull('parent_id')->get();

        return response()->json([
            'data' => $categories,
            'msg' => 'success'
        ],200);
    }

    public function show($slug){
        $category = Category::with('children')->where('slug',$slug)->first();

        return response()->json([
            'data' => $category,
            'msg' => 'success'
        ],200);
    }

    // product list by category

    public function products($slug){
        $category = Category::where('slug',$slug)->first();
        $products = $category->products;

        return response()->json([
            'data' => $products,
            'msg' => 'success'
        ],200);
    }


}
