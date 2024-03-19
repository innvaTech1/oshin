<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class WishlistController extends Controller
{
    // get wishlists
    public function index()
    {
        $wishlists = auth()->user()->wishlistItems()->with('product')->get();

        return response()->json([
            'data' => $wishlists,
            'msg' => 'success',
        ], 200);
    }

    // add wishlist

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        $wishlist = auth()->user()->wishlistItems()->create([
            'product_id' => $request->product_id,
        ]);

        return response()->json([
            'data' => $wishlist,
            'msg' => 'success',
        ], 200);
    }

    // remove wishlist

    public function destroy($id)
    {
        $wishlist = auth()->user()->wishlistItems()->where('id', $id)->first();
        if ($wishlist) {
            $wishlist->delete();
            return response()->json([
                'msg' => 'success',
            ], 200);
        }
        return response()->json([
            'msg' => 'error',
        ], 404);

    }
}
