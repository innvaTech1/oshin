<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Order\app\Services\OrderService;

class OrderController extends Controller
{
    protected $orderService;
    public function __construct(OrderService $orderService)
    {
        $this->orderService = $orderService;
    }

    public function index(Request $request)
    {
        $user = $request->user();
        $orders = $this->orderService->getUserOrders($user);

        if ($orders->count() > 0) {
            return responseSuccess($orders, 'All Orders',200);
        }else
        {
            return responseFail('No Orders Found', 404);
        }
    }

    public function show(Request $request, $id)
    {
        $order = $this->orderService->getOrder($id);

        if ($order) {
            return responseSuccess($order, 'Order Details', 200);
        }else
        {
            return responseFail('Order Not Found', 404);
        }
    }

    public function store(Request $request)
    {
        $user = $request->user();
        $cart = $request->cart;
        $order = $this->orderService->storeOrder($request, $user, $cart);

        if ($order) {
            return responseSuccess($order, 'Order Placed Successfully', 200);
        }else
        {
            return responseFail('Order Not Placed', 400);
        }
    }
}
