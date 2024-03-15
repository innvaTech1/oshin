<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\AttributeService;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\UnitTypeService;
use App\Traits\LogActivity;
use Illuminate\Support\Facades\DB;

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

    public function store(ProductRequest $request)
    {
        dd($request->all());
        DB::beginTransaction();
        try {
            $this->productService->create($request->except("_token"));
            DB::commit();
            // Toastr::success(__('common.added_successfully'), __('common.success'));
            LogActivity::successLog('product upload successful.');
            if ($request->request_from == 'main_product_form') {
                return redirect()->route('product.index');
            } elseif ($request->request_from == 'seller_product_form') {
                return redirect()->route('seller.product.index');
            } elseif ($request->request_from == 'inhouse_product_form') {
                return redirect()->route('admin.my-product.index');
            }
        } catch (\Exception $e) {
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            // Toastr::error(__('common.error_message'));
            return back();
        }
    }
}
