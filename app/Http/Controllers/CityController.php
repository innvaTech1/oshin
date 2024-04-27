<?php

namespace App\Http\Controllers;

use App\Enums\RedirectType;
use App\Models\City;
use App\Models\Country;
use App\Models\District;
use App\Models\State;
use App\Models\Thana;
use App\Traits\RedirectHelperTrait;
use Illuminate\Http\Request;

class CityController extends Controller
{
    use RedirectHelperTrait;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // abort_unless(checkAdminHasPermission('city.list'), 403);
        $thanas = Thana::with(['district']);

        if(request()->search)
        {
            $thanas = $thanas->where('name', 'like', '%'.request()->search.'%');
        }
        $thanas = $thanas->paginate(10);

        return view('admin.locations.cities.index',compact('thanas'));
    }
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // abort_unless(checkAdminHasPermission('city.create'), 403);
        $districts = District::all();
        return view('admin.locations.cities.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // abort_unless(checkAdminHasPermission('city.store'), 403);
        $request->validate([
            'name' => 'required|unique:thanas,name',
            "district_id" => "required",
        ], [
            'name.required' => 'Name is Required',
            'name.unique' => 'Name is Already Exists',
            'district_id.required' => 'District is Required',
        ]);

        $city = new Thana();
        $city->name = trim($request->name);
        $city->district_id = $request->district_id;
        $city->save();

        $notification = trans('Created Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return $this->redirectWithMessage(RedirectType::CREATE->value, 'admin.city.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // abort_unless(checkAdminHasPermission('city.show'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // abort_unless(checkAdminHasPermission('city.edit'), 403);
        $city = Thana::find($id);
        $states = District::all();

        if (!$city) {
            $notification = trans('Thana Not Found');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->route('admin.city.index')->with($notification);
        }
        return view('admin.locations.cities.edit', compact('city', 'states'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // abort_unless(checkAdminHasPermission('city.update'), 403);
        $city = Thana::find($id);
        if (!$city) {
            $notification = trans('city Not Found');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->route('admin.city.index')->with($notification);
        }
        $request->validate([
            'name' => 'required|unique:thanas,name,' . $id,
            "district_id" => "required",
        ], [
            'name.required' => 'Name is Required',
            'name.unique' => 'Name is Already Exists',
            'district_id.required' => 'District is Required',
        ]);

        $city->name = trim($request->name);
        $city->district_id = $request->district_id;
        $city->save();

        $notification = trans('Updated Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->route('admin.city.index')->with($notification);
        return $this->redirectWithMessage(RedirectType::UPDATE->value, 'admin.city.index');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // abort_unless(checkAdminHasPermission('city.delete'), 403);
        $city = Thana::find($id);
        if (!$city) {
            $notification = trans('Thana Not Found');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return $this->redirectWithMessage(RedirectType::ERROR->value, 'admin.city.index');
        } else {
            $city->delete();
            $notification = trans('Delete Successfully');
            $notification = array('messege' => $notification, 'alert-type' => 'success');
            return $this->redirectWithMessage(RedirectType::CREATE->value, 'admin.city.index');
        }
    }
    /**
     * Get all resources By State Id from storage.
     */
    public function getAllCitiesByState(string $id)
    {
        $cities = District::find($id)->thanas;
        if ($cities->count() > 0) {
            return ['status' => 200, 'data' => $cities];
        } else {
            return ['status' => 404, 'message' => 'Districts Not Found', 'data' => []];
        }
    }
}
