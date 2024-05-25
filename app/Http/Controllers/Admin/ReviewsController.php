<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Traits\RedirectHelperTrait;
use Modules\Order\app\Models\OrderReview;

class ReviewsController extends Controller
{
    use RedirectHelperTrait;
    public function __construct()
    {
        $this->middleware('auth:admin');
    }
    public function reviews()
    {
        // abort_unless(checkAdminHasPermission('reviews.list'), 403);
        $reviews = OrderReview::with('user')->latest()->get();
        return view('admin.pages.reviews.index', compact('reviews'));
    }
    public function deleteReview($id)
    {
        // abort_unless(checkAdminHasPermission('reviews.delete'), 403);
        $review = OrderReview::find($id);
        $review->delete();
        return $this->redirectWithMessage(RedirectType::DELETE->value, 'admin.reviews');
    }
}
