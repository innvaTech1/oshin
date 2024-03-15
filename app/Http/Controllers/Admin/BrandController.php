<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Http\Requests\BrandRequest;
use App\Models\Brand;
use App\Services\BrandService;
use App\Traits\LogActivity;
use App\Traits\RedirectHelperTrait;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    use RedirectHelperTrait;
    protected $brandService;

    public function __construct(BrandService $brandService)
    {
        $this->brandService = $brandService;
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.pages.brand.index', compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.pages.brand.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BrandRequest $request)
    {
        try {
            $this->brandService->save($request->except("_token"));
            LogActivity::successLog('Brand Added.');
            $this->redirectWithMessage(RedirectType::CREATE->value, 'admin.brand.index', [], ['messege' => 'Brand Added Successfully', 'alert-type' => 'success']);
            if (isset($request->form_type)) {
                if ($request->form_type == 'modal_form') {
                    $brands = $this->brandService->getActiveAll();
                    return view('product::products.components._brand_list_select', compact('brands'));
                } else {
                    return redirect()->route('admin.brand.index');
                }
            } else {
                return redirect()->route('admin.brand.index');
            }
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            $this->redirectWithMessage(RedirectType::ERROR->value, 'admin.brand.index', [], ['messege' => 'Something Went Wront', 'alert-type' => 'error']);
            return back();
        }

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        try {
            $brand = $this->brandService->findById($id);
            return view('admin.pages.brand.edit', compact('brand'));
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            return back();
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {

        try {
            $this->brandService->update($request->except("_token"), $id);
            LogActivity::successLog('Brand Updated.');
            $this->redirectWithMessage(RedirectType::UPDATE->value, 'admin.brand.index', [], ['messege' => 'Brand Updated Successfully', 'alert-type' => 'success']);
            return redirect()->route('admin.brand.index');
        } catch (\Exception $e) {
            LogActivity::errorLog($e->getMessage());
            $this->redirectWithMessage(RedirectType::ERROR->value, 'admin.brand.index', [], ['messege' => 'Something Went Wront', 'alert-type' => 'error']);
            return back();
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
