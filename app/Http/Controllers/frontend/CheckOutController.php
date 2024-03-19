<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CheckOutController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = [];

        // Fetch cart items from the database for the authenticated user if available
        if (Auth::check()) {
            $db_cart = Cart::with('product:id,product_name,thumbnail_image_source,slug,brand_id', 'product.brand:id,name')
                ->where('user_id', Auth::id())
                ->get();
        } else {
            $db_cart = collect(); // Initialize an empty collection if not authenticated
        }

        if (Auth::check() && session()->has('cart')) {
            // Iterate through session cart items
            foreach (session()->get('cart') as $productID => $session_item) {
                // Check if the product ID exists in the database cart items
                $existing_db_item = $db_cart->where('product_id', $productID)->first();

                if ($existing_db_item) {
                    // If the product exists in the database cart items, update the quantity
                    $existing_db_item->quantity += $session_item['quantity'];
                    $existing_db_item->save(); // Save the changes
                } else {
                    // If the product doesn't exist in the database cart items, add it
                    // Create a new cart item
                    $new_cart_item = new Cart();
                    $new_cart_item->user_id = Auth::id(); // This will be null if not authenticated
                    $new_cart_item->product_id = $productID;
                    $new_cart_item->quantity = $session_item['quantity'];
                    $new_cart_item->total_amount = rand(100, 400);
                    $new_cart_item->save();
                }
            }
        }

        // Return the appropriate data based on authentication status
        if (Auth::check()) {
            $cart = $db_cart;
        } else {
            $cart_items = [];

            if (session()->has('cart')) {
                foreach (session()->get('cart') as $productID => $session_item) {
                    $product = Product::select('id', 'product_name', 'slug', 'thumbnail_image_source', 'brand_id')
                        ->where('id', $productID)
                        ->with('brand:id,name')
                        ->first();

                    // Build the cart item structure
                    $cart_item = [
                        'id' => $session_item['cart_id'],
                        'user_id' => null,
                        'product_id' => $productID,
                        'quantity' => $session_item['quantity'],
                        'total_amount' => rand(100, 400),
                        'product' => [
                            'id' => $product->id,
                            'product_name' => $product->product_name,
                            'thumbnail_image_source' => $product->thumbnail_image_source,
                            'slug' => $product->slug,
                            'brand_id' => $product->brand_id,
                            'brand' => [
                                'id' => $product->brand->id,
                                'name' => $product->brand->name,
                            ],
                        ],
                    ];

                    // Add the cart item to the cart array
                    $cart_items[] = $cart_item;
                    $cart = array_map(function ($item) {
                        return json_decode(json_encode($item));
                    }, $cart_items);
                }
            }
        }

        if (empty($cart)) {
            return redirect()->route('home')->with('error', 'Add something to cart first');
        } else {
            return view('frontend.checkout', [
                'cart' => $cart
            ]);
        }
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
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
