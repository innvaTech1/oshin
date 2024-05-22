<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Address;
use App\Traits\MailSenderTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Modules\Order\app\Models\Order;
use Modules\Order\app\Models\OrderDetails;
use Modules\Order\app\Services\OrderService;
use Modules\Product\app\Models\Product;
use Modules\Product\app\Models\Variant;

class OrderController extends Controller
{
    use MailSenderTrait;
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
            return responseSuccess($orders, 'All Orders', 200);
        } else {
            return responseFail('No Orders Found', 404);
        }
    }

    public function show(Request $request, $id)
    {
        $order = $this->orderService->getOrder($id);

        if ($order) {
            return responseSuccess($order, 'Order Details', 200);
        } else {
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
        } else {
            return responseFail('Order Not Placed', 400);
        }
    }

    public function create(Request $request)
    {
        $user = $request->user();

        return $this->createGuest($request, $user);
    }
    public function createGuest(Request $request, $user = null)
    {
        try {
            if ($request->cart == null) {
                return responseFail('cart can\'t be empty');
            }
            if ($request->shipping == null) {
                return responseFail('Shipping Address Required');
            }


            DB::beginTransaction();
            $address_id = null;
            if ($request->shipping['shippingAddress'] != null) {
                $shippingAddress = $this->createAddress([
                    'address' => $request->shipping['shippingAddress'],
                    'fullName' => $request->shipping['shippingFullName'],
                    'phone' => $request->shipping['shippingMobileNumber'],
                    'district' => $request->shipping['shippingDistrict'],
                    'city' => $request->shipping['shippingThana'],
                    'email' => $request->shipping['shippingEmail'],
                ]);
                $address_id = $shippingAddress->id;
            }

            $billing_id = null;

            if ($request->shipping['sameAsShipping'] == false) {
                $billingAddress = $this->createAddress([
                    'address' => $request->shipping['billingAddress'],
                    'fullName' => $request->shipping['billingFullName'],
                    'phone' => $request->shipping['billingMobileNumber'],
                    'district' => $request->shipping['billingDistrict'],
                    'city' => $request->shipping['billingThana'],
                    'email' => $request->shipping['billingEmail'],
                ]);
                $billing_id = $billingAddress->id;
            }


            $coupon = json_decode($request->coupon)?->data;
            $payment = $request->payment;
            $cart = $request->cart;

            $data = [
                'address_id' => $address_id,
                'billing_address_id' => $billing_id,
                'delivery_fee' => $request->shippingFee,
                'tax' => isset($request->shipping['tax']) ? $request->shipping['tax'] : 0,
                'discount' => isset($coupon?->discount) ? $coupon->discount : 0,
                'order_total_fee' => $request->total,
                'order_sub_total' => $request->subTotal,
                'order_payment_details' => $payment ? $payment['paymentDetails'] : null,
                'order_payment_method' => $request->shipping['paymentMethod'],
                'order_delivery_method' => $request->shipping['shippingArea'],
            ];

            $order = $this->storeOrder($data, $user, $cart);

            if ($order) {
                DB::commit();
                return responseSuccess($order, 'Order Placed Successfully', 200);
            } else {
                DB::rollBack();
                return responseFail('Order Not Placed', 400);
            }
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            return responseFail('Order Not Placed', 400);
        }
    }


    private function createAddress($address)
    {
        $address = Address::create([
            "name" => $address['fullName'],
            "address" => $address['address'],
            "phone" => $address['phone'],
            "email" => $address['email'],
            "state" => $address['district'],
            "city" => $address['city'],
        ]);

        return $address;
    }

    public function storeOrder(array $data, $user, $cart)
    {
        $order = new Order();
        $order->order_id = substr(rand(0, time()), 0, 10);
        $order->user_id = $user != null ?  $user->id : null;
        $order->walk_in_customer = $user != null ?  0 : 1;
        $order->address_id = $data['address_id'];
        $order->billing_address_id = $data['billing_address_id'];
        $order->delivery_fee = $data['delivery_fee'];
        $order->tax = isset($data['tax']) ? $data['tax'] : 0;
        $order->discount = isset($data['discount']) ? $data['discount'] : 0;
        $order->order_delivery_date = null;
        $order->total_amount = $data['order_total_fee'];
        $order->currency_rate = cache()->get('currency')->currency_rate;
        $order->currency_name = cache()->get('currency')->currency_name;
        $order->currency_icon = cache()->get('currency')->currency_icon;
        $order->order_amount = $data['order_sub_total'];
        $order->payment_details = $data['order_payment_details'];
        $order->payment_method = $data['order_payment_method'];
        $order->delivery_method = $data['order_delivery_method'];
        $order->payment_status = 'pending';
        $order->order_status = 'pending';
        $order->delivery_status = 1;

        $order->save();

        // if ($user != null) {
        //     $this->sendOrderSuccessMail($user, $order);
        // }

        $maxDeliveryDate = [];
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            if ($product->max_delivery_time != null) {
                $maxDeliveryDate[] = $product->delivery_time;
            }

            $variant = isset($item['variant']) ?  Variant::where('sku', $item['sku'])->first() : null;
            $orderDetails = new OrderDetails();
            $orderDetails->order_id = $order->id;
            $orderDetails->product_id = $item['product_id'];
            $orderDetails->product_name = $item['name'];
            $orderDetails->product_sku = $item['sku'];
            $orderDetails->variant_id = $variant != null ? $variant->id : null;
            $orderDetails->price = $item['price'];
            $orderDetails->quantity = $item['quantity'];
            $orderDetails->total = $item['totalPrice'];
            $orderDetails->attributes = $variant != null ? $item['variant']['attribute'] : null;
            $orderDetails->status = 1;
            $orderDetails->save();
        }

        if (count($maxDeliveryDate) > 0) {

            // get the max delivery date

            $maxDeliveryDate = max($maxDeliveryDate);

            // add the max delivery date to the order delivery date
            $order->order_delivery_date = now()->addDays($maxDeliveryDate);
            $order->save();
        }

        return $order;
    }
}
