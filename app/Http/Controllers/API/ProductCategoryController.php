<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\CategoryResource;
use App\Http\Resources\ProductResource;

use Illuminate\Http\Request;
use Modules\Product\app\Services\ProductCategoryService;

class ProductCategoryController extends Controller
{
    protected $categoryService;

    public function __construct(ProductCategoryService $categoryService)
    {
        $this->categoryService = $categoryService;
    }
    public function index()
    {
        $categories = $this->categoryService->getParentCategory();
        if (count($categories) > 0) {
            return responseSuccess(CategoryResource::collection($categories));
        } else {
            return responseFail('Categories not found', 404);
        }
    }

    public function topCategories()
    {
        $categories = $this->categoryService->getTopProductCategories()->limit(6)->get();
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
        $products = $this->categoryService->getProductByCategory($slug);
        if (count($products) > 0) {
            return responseSuccess(ProductResource::collection($products));
        } else {
            return responseFail('Products not found', 404);
        }
    }
}
