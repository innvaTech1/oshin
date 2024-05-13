<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\WishListResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class WishlistController extends Controller
{
    // get wishlists
    public function index()
    {
        $user = auth()->user();
        if (!$user) {
            return responseFail('User not found', 404);
        }
        return responseSuccess(WishListResource::collection($user->wishlistItems), 'Wishlist items', 200);
    }

    // add wishlist

    public function store(Request $request)
    {
        $validator = Validator::make(
            $request->all(),
            [
                'product_id' => 'required|exists:products,id',
            ]
        );

        if ($validator->fails()) {
            return response()->json(['status' => 422, 'message' => $validator->errors()], 422);
        }

        $user = $request->user();

        if (!$user) {
            return responseFail('User not found', 404);
        }
        $wishlist = $user->wishlistItems()->where('product_id', $request->product_id)->first();
        if ($wishlist) {
            return responseFail('Product already in wishlist', 422);
        }

        $user->wishlistItems()->create([
            'product_id' => $request->product_id,
        ]);


        return responseSuccess(WishListResource::collection($user->wishlistItems), 'Product added to wishlist', 200);
    }

    // remove wishlist

    public function destroy(Request $request, $id)
    {
        $user = $request->user();
        if (!$user) {
            return responseFail('User not found', 404);
        }
        $wishlist = $user->wishlistItems()->where('id', $id)->first();
        if ($wishlist) {
            $wishlist->delete();
            return responseSuccess(WishListResource::collection($user->wishlistItems), 'Product removed from wishlist', 200);
        }
        return responseFail('Product not found in wishlist', 404);
    }
}
