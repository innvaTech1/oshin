<?php

namespace Modules\Product\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Modules\Product\app\Models\ProductStock;
use Modules\Product\app\Services\ProductService;

class ProductStockController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
        $this->middleware('auth:admin');
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = $this->productService->getProducts()->paginate(20);
        return view('product::products.stock.index',compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('product::create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): RedirectResponse
    {
        //
    }

    /**
     * Show the specified resource.
     */
    public function show($id)
    {
        return view('product::show');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        return view('product::edit');
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            'sku' => 'required',
            'quantity' => 'required',
        ]);

        $stock = ProductStock::where('sku',$request->sku);

        if($stock->exists()){
            $stock->update([
                'quantity' => $request->quantity
            ]);
        }else{

            ProductStock::create([
                'product_id' => $request->product_id,
                'sku' => $request->sku,
                'quantity' => $request->quantity
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        //
    }
}
