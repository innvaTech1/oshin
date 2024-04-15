<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Services\AttributeService;
use App\Services\BrandService;
use App\Services\CategoryService;
use App\Services\ProductService;
use App\Services\UnitTypeService;
use App\Traits\LogActivity;
use App\Traits\RedirectHelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Modules\Language\app\Traits\GenerateTranslationTrait;

class ProductController extends Controller
{
    use GenerateTranslationTrait, RedirectHelperTrait;
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
        $data['categories'] = $categoryService->getAllCategory();
        $data['brands'] = $brandService->getActiveBrands();
        return view('admin.pages.products.create', compact('data'));
    }

    public function store(ProductRequest $request)
    {
        DB::beginTransaction();
        try {
            $this->productService->create($request);
            DB::commit();
            
            LogActivity::successLog('product upload successful.');

            return $this->redirectWithMessage(RedirectType::CREATE->value, 'admin.product.index');

        } catch (\Exception $e) {
            DB::rollBack();
            LogActivity::errorLog($e->getMessage());
            // Toastr::error(__('common.error_message'));
            return back();
        }
    }
    public function productWholesaleModal(Request $request){
        $data = $request->except('_token');
        return view('admin.pages.products.components.wholesale_price_modal',compact('data'))->render();
    }
}
