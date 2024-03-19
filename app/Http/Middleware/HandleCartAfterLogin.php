<?php

namespace App\Http\Middleware;

use App\Models\Cart;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class HandleCartAfterLogin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {

        if (Auth::check()) {
            $cartItems = session()->get('cart', []);

            if (!empty($cartItems)) {
                foreach ($cartItems as $productId => $item) {
                    $existingCartItem = Cart::where('user_id', Auth::id())
                        ->where('product_id', $productId)
                        ->first();

                    if ($existingCartItem) {
                        $existingCartItem->quantity += $item['quantity'];
                        $existingCartItem->save();
                    } else {
                        $newCartItem = new Cart();
                        $newCartItem->user_id = Auth::id();
                        $newCartItem->product_id = $productId;
                        $newCartItem->quantity = $item['quantity'];
                        $newCartItem->save();
                    }
                }

                session()->forget('cart');
            }
        }

        return $next($request);
    }
}
