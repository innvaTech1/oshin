<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Services\AttributeService;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\UnitTypeService;

class ProductController extends Controller
{
    protected $productService;
    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }
    public function index()
    {
        $products = $this->productService->all();
        return view('admin.pages.products.index', compact('products'));
    }
    public function create(CategoryService $categoryService, UnitTypeService $unitTypeService, BrandService $brandService, AttributeService $attributeService, )
    {
        $data['units'] = $unitTypeService->getActiveAll();
        $data['attributes'] = $attributeService->getActiveAll();
        // $data['products'] = $this->productService->allbyPaginate();
        $data['categories'] = $categoryService->getAll();
        $data['brands'] = $brandService->getAll();

        return view('admin.pages.products.create', compact('data'));
    }
}
