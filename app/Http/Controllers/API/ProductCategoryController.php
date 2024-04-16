<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\Request;

class ProductCategoryController extends Controller
{
    protected $categoryService;

    public function __construct(CategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        $categories = $this->categoryService->getActiveAll();
        if (count($categories) > 0) {
            return responseSuccess(CategoryResource::collection($categories));
        } else {
            return responseFail('Categories not found', 404);
        }
    }

    public function show($slug)
    {
        $category = $this->categoryService->findBySlug($slug);
        if ($category) {
            return responseSuccess($category);
        } else {
            return responseFail('Category not found', 404);
        }
    }

    // product list by category

    public function products($slug)
    {
        $category = Category::where('slug', $slug)->first();
        $products = $category->products;

        return response()->json([
            'data' => $products,
            'msg' => 'success'
        ], 200);
    }
}
