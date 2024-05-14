<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;
use Modules\Order\app\Models\Order;
use Modules\Order\app\Models\OrderDetails;
use Modules\Order\app\Models\OrderReview;
use Modules\Product\app\Services\ProductService;

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

            $productResource = new ProductResource($product);

            $data['product'] = $productResource;
            $prodVar = $this->productService->getProductVariants($product);
            $data['variants'] = $prodVar;


            $user = auth('web')->user();
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
                if ($orderDetails && !(OrderReview::where('product_id', $product->id)->exists())) {
                    $canGiveReview = true;
                }
            }

            $reviews = OrderReview::where('product_id', $product->id)->all();
            $data['reviews'] = $reviews;
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
            OrderReview::create([
                'order_id' => $orderDetails->order_id,
                'product_id' => $request->product_id,
                'rating' => $request->rating,
                'comment' => $request->comment,
                'user_id' => $userId,
                'status' => 1,
            ]);
            return responseSuccess('Review added successfully');
        }
        return responseFail('You can not review this product', 400);
    }
}
