<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\AddressResouce;
use App\Http\Resources\AddressResource;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function createAddress(Request $request)
    {
        $user = $request->user();

        if ($user == null) {
            return responseFail('User Not Found', 404);
        }

        $user->addresses()->create([
            "name" => $request['billingFullName'],
            "address" => $request['billingAddress'],
            "phone" => $request['billingMobileNumber'],
            "email" => $request['billingEmail'],
            "state" => $request['billingDistrict'],
            "city" => $request['billingThana'],
            'is_default' => $request['default_address'] == 'true' ? 1 : 0,
        ]);
        return responseSuccess(AddressResource::collection($user->addresses), 'Address created successfully', 201);
    }

    public function getAddresses(Request $request)
    {
        $user = $request->user();

        if ($user == null) {
            return responseFail('User Not Found', 404);
        }
        $addresses = $user->addresses;
        return responseSuccess(AddressResource::collection($addresses), 'All Addresses', 200);
    }

    public function getAddress(Request $request, $id)
    {
        $user = $request->user();

        if ($user == null) {
            return responseFail('User Not Found', 404);
        }
        $address = $user->addresses()->findOrFail($id);
        return responseSuccess(new AddressResource($address), 'Address Details', 200);
    }
    public function updateAddress(Request $request, $id)
    {
        $user = $request->user();

        if ($user == null) {
            return responseFail('User Not Found', 404);
        }
        $address = $user->addresses()->findOrFail($id);
        $address->update($request->all());
        return responseSuccess(new AddressResource($address), 'Address updated successfully', 200);
    }
    public function deleteAddress(Request $request, $id)
    {
        $user = $request->user();

        if ($user == null) {
            return responseFail('User Not Found', 404);
        }
        $address = $user->addresses()->findOrFail($id);
        $address->delete();
        return responseSuccess(AddressResource::collection($user->addresses), 'Address deleted successfully', 200);
    }
}
