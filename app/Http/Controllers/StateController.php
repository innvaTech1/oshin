<?php

namespace App\Http\Controllers;

use App\Models\Country;
use App\Models\District;
use App\Models\State;
use Illuminate\Http\Request;

class StateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // abort_unless(checkAdminHasPermission('state.list'), 403);
        $states = District::query();
        if(request()->search)
        {
            $states = $states->where('name', 'like', '%'.request()->search.'%');
        }
        $states = $states->paginate(10);
        return view('admin.locations.states.index', compact('states'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // abort_unless(checkAdminHasPermission('state.create'), 403);
        $districts = District::all();
        return view('admin.locations.states.create', compact('districts'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // abort_unless(checkAdminHasPermission('state.store'), 403);
        $request->validate([
            'name' => 'required|unique:districts,name',
        ], [
            'name.required' => 'Name is Required',
            'name.unique' => 'Name is Already Exists',
        ]);

        $state = new District();
        $state->name = trim($request->name);
        $state->save();

        $notification = trans('Created Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->route('admin.state.index')->with($notification);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // abort_unless(checkAdminHasPermission('state.edit'), 403);
        $state = District::find($id);
        if (!$state) {
            $notification = trans('District Not Found');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->route('admin.state.index')->with($notification);
        }
        return view('admin.locations.states.edit', compact('state'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // abort_unless(checkAdminHasPermission('state.update'), 403);
        $state = District::find($id);
        if (!$state) {
            $notification = trans('District Not Found');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->route('admin.state.index')->with($notification);
        }
        $request->validate([
            'name' => 'required|unique:districts,name,' . $id,

        ], [
            'name.required' => 'Name is Required',
            'name.unique' => 'Name is Already Exists',
        ]);

        $state->name = trim($request->name);
        $state->save();

        $notification = trans('Updated Successfully');
        $notification = array('messege' => $notification, 'alert-type' => 'success');
        return redirect()->route('admin.state.index')->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // abort_unless(checkAdminHasPermission('state.delete'), 403);

        $state = District::find($id);
        if (!$state) {
            $notification = trans('District Not Found');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->route('admin.state.index')->with($notification);
        } else {
            $state->delete();
            $notification = trans('Delete Successfully');
            $notification = array('messege' => $notification, 'alert-type' => 'success');
            return redirect()->route('admin.state.index')->with($notification);
        }
    }
}
