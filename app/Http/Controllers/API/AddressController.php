<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AddressController extends Controller
{
    public function createAddress(Request $request)
    {
        $user = $request->user();
        $user->addresses()->create([
            "name" => $request['billingFullName'],
            "address" => $request['billingAddress'],
            "phone" => $request['billingMobileNumber'],
            "email" => $request['billingEmail'],
            "state" => $request['billingDistrict'],
            "city" => $request['billingThana'],
            'is_default' => $request['default_address'] == 'true' ? 1 : 0,
        ]);
        return responseSuccess($user->addresses, 'Address created successfully', 201);
    }

    public function getAddresses(Request $request)
    {
        $user = $request->user();
        $addresses = $user->addresses;
        return response()->json(['addresses' => $addresses]);
    }
    public function updateAddress(Request $request, $id)
    {
        $user = $request->user();
        $address = $user->addresses()->findOrFail($id);
        $address->update($request->all());
        return response()->json(['message' => 'Address updated successfully']);
    }
    public function deleteAddress(Request $request, $id)
    {
        $user = $request->user();
        $address = $user->addresses()->findOrFail($id);
        $address->delete();
        return response()->json(['message' => 'Address deleted successfully']);
    }
}
