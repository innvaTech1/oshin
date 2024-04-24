<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\ShippingMethodResource;
use App\Services\ShippingMethodService;

class ShippingMethodController extends Controller
{
    protected $shippingMethodService;

    public function __construct(ShippingMethodService $shippingMethodService)
    {
        $this->shippingMethodService = $shippingMethodService;
    }

    public function index()
    {
        $shippings = $this->shippingMethodService->getActive();
        
        if ($shippings->isEmpty()) {
            return responseFail('No shipping methods found', 404);
        }
        $shippings = ShippingMethodResource::collection($shippings);
        return responseSuccess($shippings, 'Shipping methods retrieved successfully',200);
    }

    public function show($id)
    {
        $shipping = $this->shippingMethodService->find($id);
        if (!$shipping) {
            return responseFail('Shipping method not found', 404);
        }
        $shipping = new ShippingMethodResource($shipping);
        
        return responseSuccess($shipping, 'Shipping method retrieved successfully',200);
    }
}
