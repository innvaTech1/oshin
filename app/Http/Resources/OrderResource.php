<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class OrderResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'order_id' => $this->order_id,
            'address_id' => $this->address_id,
            'address' => $this->address,
            'billing_address' => $this->billingAddress,
            'delivery_fee' => $this->delivery_fee,
            'tax' => $this->tax,
            'discount' => $this->discount,
            'total_amount' => $this->total_amount,
            'order_amount' => $this->order_amount,
            'payment_details' => $this->payment_details,
            'payment_method' => allPaymentMethods($this->payment_method),
            'delivery_method' => $this->delivery_method,
            'payment_status' => $this->payment_status,
            'order_status' => $this->order_status,
            'delivery_status' => getOrderStatus($this->delivery_status),
            'created_at' => $this->created_at->format('d M Y H:i A'),
            'order_details' => OrderDetailsResource::collection($this->orderDetails),
            'order_delivery_date' => $this->order_delivery_date,
        ];
    }
}
