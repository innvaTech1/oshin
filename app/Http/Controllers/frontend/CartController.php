<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $cart = [];

        // Fetch cart items from the database for the authenticated user if available
        if (auth()->check()) {
            $db_cart = Cart::with('product:id,product_name,thumbnail_image_source,slug,brand_id', 'product.brand:id,name')
                ->where('user_id', auth()->id())
                ->get();
        } else {
            $db_cart = collect(); // Initialize an empty collection if not authenticated
        }

        if (auth()->check() && session()->has('cart')) {
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
                    $new_cart_item->user_id = auth()->id(); // This will be null if not authenticated
                    $new_cart_item->product_id = $productID;
                    $new_cart_item->quantity = $session_item['quantity'];
                    $new_cart_item->total_amount = rand(100, 400);
                    $new_cart_item->save();
                }
            }
        }

        // Return the appropriate data based on authentication status
        if (auth()->check()) {
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
        try {
            $productId = $request->input('product_id');
            $quantity = $request->input('quantity');
            $actionType = $request->input('type');

            if (auth()->check()) {
                // Retrieve the product and handle cart for authenticated users
                $cart = Cart::updateOrCreate(
                    ['user_id' => auth()->id(), 'product_id' => $productId],
                    ['quantity' => $quantity, 'total_amount' => rand(100, 400)] // Temporary random total_amount
                );

                // Store cartID in the session
                session()->put('cartID', $cart->id);
                $cartID = session()->get('cartID', null);

                // Continue with other operations
                $product = $cart->getProduct()->first();

                // Determine the action type and return the appropriate response
                $message = match ($actionType) {
                    'ADD' => 'Product added to cart successfully.',
                    'INC' => 'Quantity of the product increased successfully.',
                    default => 'Quantity of the product decreased successfully.', //decrease the quantity
                };

                if ($quantity == 0) {
                    $cart->delete();
                    session()->forget('cartID');
                    return response()->json(['message' => 'Product was removed from cart.', 'cartID' => $cartID]);
                }

                return response()->json(['message' => $message, 'cart' => $cart, 'product' => $product, 'cartID' => $cartID]);
            } else {
                $cartItems = session()->get('cart', []);
                $cartItem = $cartItems[$productId] ?? null;
                $randCartID = null;

                // Get the quantity of the cart item from the session, if available
                $cartqty = $cartItem ? $cartItem['quantity'] : null;

                // Generate a random cart ID if the product is not already in the session cart
                if ($cartItem === null) {
                    $randCartID = uniqid();
                } else {
                    // If the product is already in the session, use its existing cart ID
                    $randCartID = $cartItem['cart_id'];
                }

                // Store the cartID in the session
                session()->put('cartID', $randCartID);
                $cartID = session()->get('cartID', null);

                // If the product is already in the session, update its quantity
                if ($quantity > 0) {
                    if ($cartItem !== null) {
                        $cartItem['quantity'] = $quantity;
                    } else {
                        // Otherwise, add the product to the session cart
                        $cartItem = [
                            'cart_id' => $randCartID,
                            'product_id' => $productId,
                            'quantity' => $quantity,
                        ];
                    }

                    // Update the cart session variable
                    $cartItems[$productId] = $cartItem;
                    session()->put('cart', $cartItems);
                }

                // Retrieve product details
                $product = Product::findOrFail($productId);

                // Prepare the response
                if ($quantity > 0 && $cartqty === null) {
                    // Product added to cart for the first time
                    return response()->json(['message' => 'Product added to cart successfully.', 'cartID' => $cartID, 'cart' => ['id' => $randCartID, 'quantity' => $quantity], 'product' => $product]);
                } elseif ($quantity > $cartqty) {
                    // Quantity of the product increased
                    return response()->json(['message' => 'Quantity of the product increased successfully.', 'cartID' => $cartID, 'cart' => ['id' => $randCartID, 'quantity' => $quantity], 'product' => $product]);
                } elseif ($quantity < $cartqty && $quantity != 0) {
                    // Quantity of the product decreased
                    return response()->json(['message' => 'Quantity of the product decreased successfully.', 'cartID' => $cartID, 'cart' => ['id' => $randCartID, 'quantity' => $quantity], 'product' => $product]);
                } elseif ($quantity == 0) {
                    // Product removed from cart
                    unset($cartItems[$productId]);
                    session()->put('cart', $cartItems);
                    return response()->json(['message' => 'Product was removed from cart.', 'cartID' => $cartID]);
                }
            }
        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'Something went wrong. Please try again.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {

            if (auth()->check()) {
                // Find the cart entry by its ID and ensure it belongs to the authenticated user
                $cart = Cart::where('id', $id)
                    ->where('user_id', auth()->id())
                    ->firstOrFail();

                // Delete the wishlist entry
                $cart->delete();
            } else {
                $cart = session()->get('cart');
                foreach ($cart as $key => $item) {
                    if ($item['cart_id'] == $id) {
                        unset($cart[$key]);
                        break; // Exit the loop after removing the item
                    }
                }
                session()->put('cart', $cart);
            }
            // Return a success response
            return response()->json(['message' => 'Item removed from cart.'], 200);
        } catch (\Exception $e) {
            // Return an error response if the wishlist entry is not found or doesn't belong to the user
            return response()->json(['message' => 'Failed to remove cart item.'], 404);
        }
    }
}
