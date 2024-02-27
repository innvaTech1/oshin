<?php

namespace App\Http\Controllers\frontend;

use App\Http\Controllers\Controller;
use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;

class WishlistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $items = Wishlist::with(['product' => function ($query) {
            $query->select('id', 'slug', 'thumbnail_image_source', 'product_name', 'specification', 'model_number')
                ->with(['cart' => function ($query) {
                    $query->where('user_id', Auth::id());
                }]);
        }])->where('user_id', Auth::id())->get();

        // dd($items);

        return view('frontend.wishlist', [
            'items' => $items
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

        if (!Auth::check()) {
            Session::put('url.mymade', 'something'); //make an static route and use it as intended
            return response()->json(['message' => 'Unauthenticated! Please login to continue.'], 401);
        }

        // Validate the request
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        try {
            // Check if the user has already added the product to their wishlist
            $existingWishlist = Wishlist::where('user_id', Auth::id())
                ->where('product_id', $request->product_id)
                ->first();

            if ($existingWishlist) {
                // Product already in wishlist, delete the existing entry
                $existingWishlist->delete();
                // Return an error response
                return response()->json(['message' => 'Product removed from wishlist.', 'type' => 'removed'], 200);
            }
            // Create a new Wishlist record
            $wishlist = new Wishlist();
            $wishlist->user_id = Auth::id();
            $wishlist->product_id = $request->product_id;
            $wishlist->save();

            // Return a success response
            return response()->json(['message' => 'Added to wishlist successfully', 'type' => 'added'], 200);
        } catch (\Exception $e) {
            // Return an error response
            return response()->json(['message' => 'Failed to add to wishlist. Please try again.'], 500);
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
        try {
            // Find the wishlist entry by its ID and ensure it belongs to the authenticated user
            $wishlist = Wishlist::where('id', $id)
                ->where('user_id', Auth::id())
                ->firstOrFail();

            // Delete the wishlist entry
            $wishlist->delete();

            // Return a success response
            return response()->json(['message' => 'Wishlist item removed successfully.'], 200);
        } catch (\Exception $e) {
            // Return an error response if the wishlist entry is not found or doesn't belong to the user
            return response()->json(['error' => 'Failed to remove wishlist item.'], 404);
        }
    }
}
