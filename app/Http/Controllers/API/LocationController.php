<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Http\Resources\LocationResource;
use App\Models\District;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    // get all districts
    public function getDistricts()
    {
        $districts = District::all();
        
        if($districts->count() > 0){
            $districts = LocationResource::collection($districts);
            return responseSuccess($districts, 'Districts retrieved successfully',200);
        }
        
        return responseFail('No Districts Found', 404);
    }

    // get all thanas
    public function getThanas($district_id)
    {
        $thanas = District::find($district_id)->thanas;
        
        if($thanas->count() > 0){
            $thanas = LocationResource::collection($thanas);
            return responseSuccess($thanas, 'Thanas retrieved successfully',200);
        }
        
        return responseFail('No Thanas Found', 404);
    }
}
