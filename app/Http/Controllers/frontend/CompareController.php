<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CompareController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $compareItems = session()->get('compare');
        if (session()->has('compare') && !empty($compareItems)) {
            $products = Product::with('brand:id,name', 'cart')->select('id', 'product_name', 'slug', 'thumbnail_image_source', 'brand_id', 'description', 'specification', 'max_sell_price', DB::raw('ROUND(avg_rating) as avg_rating'))->whereIn('id', $compareItems)->where('status', true)->get();
        }

        // dd(session()->get('compare'));
        return view('frontend.compare', [
            'products' => $products
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $productId = $request->productId;
        $compare = session()->get('compare', []);
        if (!in_array($productId, $compare)) {
            $compare[] = $productId;
            session()->put('compare', $compare);
            return response()->json(['message' => 'Product added to compare.', 'status' => true], 200);
        } else {
            // Product already exists in the compare array
            return response()->json(['message' => 'Product already exists in compare.', 'status' => false], 400);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $compare = session()->get('compare', []);
            $compare = array_filter($compare, function ($value) use ($id) {
                return $value !== $id;
            });
            session()->put('compare', $compare);
            return response()->json(['message' => 'Product removed from compare!']);
        } catch (\Exception $e) {
            dd($e->getMessage());
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }
}
