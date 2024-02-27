<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = Cart::with('product:id,product_name,thumbnail_image_source,slug,brand_id', 'product.brand:id,name')->where('user_id', Auth::id())->get();
        // dd($cart);
        return view('frontend.cart', [
            'cart' => $cart
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $userID = Auth::id();
        $productId = $request->input('product_id');
        $quantity = $request->input('quantity');
        $actionType = $request->input('type');
        $page = $request->input('page') || null;

        if ($quantity > 5 || $quantity < 0) {
            $notification = array('messege' => 'Product quantity maximun exceeded.', 'alert-type' => 'error');
            if ($page == 'product_page') {
                return redirect()->back()->with($notification);
            }
            return response()->json(['message' => 'Product quantity maximun exceeded.'],400);
        }
        if ($page == 'product_page' && $quantity == 0) {
            $quantity = 1;
        }

        // Retrieve the product
        // $product = Product::find($productId);

        // Calculate total amount
        // $totalAmount = $product->price * $quantity;

        // Create or update cart record
        $cart = Cart::updateOrCreate(
            ['user_id' => $userID, 'product_id' => $productId],
            ['quantity' => $quantity, 'total_amount' => 100]
        );

        if ($page == 'product_page') {
            $notification = array('messege' => 'Product added to cart successfully', 'alert-type' => 'success');
            return redirect(route('cart.index'))->with($notification);
        }

        if ($quantity == 0) {
            $cart->delete();
            return response()->json(['message' => 'Product was removed from cart.']);
        }

        if ($actionType == 'ADD') {
            return response()->json(['message' => 'Product added to cart successfully.']);
        } else if ($actionType == 'INC') {
            return response()->json(['message' => 'Quantity of the product increased successfully.']);
        } else {
            return response()->json(['message' => 'Quantity of the product decresased successfully.']);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            // Find the cart entry by its ID and ensure it belongs to the authenticated user
            $cart = Cart::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            // Delete the wishlist entry
            $cart->delete();

            // Return a success response
            return response()->json(['message' => 'Item removed from cart.'], 200);
        } catch (\Exception $e) {
            // Return an error response if the wishlist entry is not found or doesn't belong to the user
            return response()->json(['message' => 'Failed to remove cart item.'], 404);
        }
    }
}
