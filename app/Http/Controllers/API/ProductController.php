<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\OrderReviewResouce;
use App\Http\Resources\OrderReviewResource;
use App\Http\Resources\ProductResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\Order\app\Models\Order;
use Modules\Order\app\Models\OrderDetails;
use Modules\Order\app\Models\OrderReview;
use Modules\Order\app\Models\ReviewImage;
use Modules\Product\app\Services\ProductService;
use PHPOpenSourceSaver\JWTAuth\Facades\JWTAuth;

class ProductController extends Controller
{
    protected $productService;

    public function __construct(ProductService $productService)
    {
        $this->productService = $productService;
    }

    public function products(Request $request)
    {
        $products = $this->productService->allActiveProducts($request);

        if ($request->limit) {
            $products = $products->limit($request->limit);
        } else {
            $products = $products->limit(18);
        }
        $products = $products->get();
        if (count($products) > 0) {
            return responseSuccess(ProductResource::collection($products));
        } else {
            return responseFail('Products not found', 404);
        }
    }

    public function featuredProducts(Request $request)
    {
        $products = $this->productService->allActiveProducts($request)->where('is_featured', 1)->get();
        if (count($products) > 0) {
            return responseSuccess(ProductResource::collection($products));
        } else {
            return responseFail('Products not found', 404);
        }
    }
    public function bestSellerProducts(Request $request)
    {
        $products = $this->productService->allActiveProducts($request)->where('is_bestseller', 1)->get();
        if (count($products) > 0) {
            return responseSuccess(ProductResource::collection($products));
        } else {
            return responseFail('Products not found', 404);
        }
    }
    public function homepageProducts(Request $request)
    {
        $products = $this->productService->allActiveProducts($request)->where('show_homepage', 1)->get();
        if (count($products) > 0) {
            return responseSuccess(ProductResource::collection($products));
        } else {
            return responseFail('Products not found', 404);
        }
    }
    public function show(Request $request, string $slug)
    {

        try {
            $product = $this->productService->getProductBySlug($slug);

            if (!$product) {
                return responseFail('Product not found', 404);
            }
            $productResource = new ProductResource($product);

            $data['product'] = $productResource;
            $prodVar = $this->productService->getProductVariants($product);
            $data['variants'] = $prodVar;

            $token = $request->bearerToken();
            $user = null;
            if ($token) {
                $user = JWTAuth::parseToken()->authenticate();
            }


            // can give reviews
            $canGiveReview = false;
            if ($user) {
                $orderDetails = Order::where('user_id', $user->id)->where('order_status', 'success')
                    ->pluck('id')
                    ->flatMap(function ($orderId) use ($product) {
                        return OrderDetails::where('order_id', $orderId)
                            ->where('product_id', $product->id)
                            ->get();
                    })
                    ->first();
                // return responseSuccess($orderDetails, 'data found');
                if ($orderDetails && !(OrderReview::where('product_id', $product->id)->exists())) {
                    $canGiveReview = true;
                }
            }


            // return $canGiveReview;

            $reviews = OrderReview::where('product_id', $product->id)->get();

            $data['reviews'] = $reviews;
            $data['canGiveReview'] = $canGiveReview;
            if ($product) {
                return responseSuccess($data);
            } else {
                return responseFail('Product not found', 404);
            }
        } catch (Exception $ex) {
            Log::error($ex->getMessage());
            return responseFail($ex->getMessage(), 500);
        }
    }

    public function postReview(Request $request)
    {
        $userId = $request->user()->id;

        if (!$userId) {
            return responseFail('Unauthorized', 401);
        }

        $validation = Validator::make($request->all(), [
            'product_id' => 'required|exists:products,id',
            'rating' => 'required|numeric|min:1|max:5',
            'comment' => 'required|string',
        ]);



        if ($validation->fails()) {
            return responseFail($validation->errors()->first(), 400);
        }

        $orderDetails = Order::where('user_id', $userId)->where('order_status', 'success')
            ->pluck('id')
            ->flatMap(function ($orderId) use ($request) {
                return OrderDetails::where('order_id', $orderId)
                    ->where('product_id', $request->product_id)
                    ->get();
            })
            ->first();

        if ($orderDetails && !(OrderReview::where('product_id', $request->product_id)->exists())) {
            $review = OrderReview::create([
                'order_id' => $orderDetails->order_id,
                'product_id' => $request->product_id,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'user_id' => $userId,
                'status' => 1,
            ]);


            if ($request->customer_review_img) {
                foreach ($request->customer_review_img as $img) {
                    $image = file_upload($img, null, 'uploads/custom_images/customer_review_img/');

                    ReviewImage::create([
                        'review_id' => $review->id,
                        'image' => $image,
                    ]);
                }
            }

            return responseSuccess('Review added successfully');
        }
        return responseFail('You can not review this product', 400);
    }

    public function getReviews(Request $request)
    {
        $user = $request->user();

        if (!$user) {
            return responseFail('Unauthorized', 401);
        }

        $reviews = $user->reviews;

        $reviews = OrderReviewResource::collection($reviews);

        return responseSuccess($reviews);
    }
}
