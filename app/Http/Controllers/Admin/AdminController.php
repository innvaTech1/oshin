<?php

namespace App\Http\Controllers\Admin;

use App\Enums\RedirectType;
use App\Http\Controllers\Controller;
use App\Models\Admin;
use App\Traits\RedirectHelperTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class AdminController extends Controller {
    use RedirectHelperTrait;

    public function index() {
        abort_unless( checkAdminHasPermission( 'admin.view' ), 403 );

        $admins = Admin::paginate( 15 );
        return view( 'admin.admin-list.admin' )->with( [
            'admins' => $admins,
        ] );

    }

    public function create() {
        abort_unless( checkAdminHasPermission( 'admin.create' ), 403 );
        $roles = Role::all();
        return view( 'admin.admin-list.create_admin', compact( 'roles' ) );
    }

    public function store( Request $request ) {
        abort_unless( checkAdminHasPermission( 'admin.store' ), 403 );
        $rules = [
            'name'     => 'required',
            'email'    => 'required|unique:admins',
            'password' => 'required|min:4',
            'status'   => 'required',
            'role'     => 'nullable|array',
        ];
        $customMessages = [
            'name.required'     => __( 'Name is required' ),
            'email.required'    => __( 'Email is required' ),
            'status.required'   => __( 'Status is required' ),
            'email.unique'      => __( 'Email already exist' ),
            'password.required' => __( 'Password is required' ),
            'password.min'      => __( 'Password Must be 4 characters' ),
            'role.array'        => __( 'You must select role' ),
        ];
        $this->validate( $request, $rules, $customMessages );

        $admin = new Admin();
        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->status = $request->status;
        $admin->password = Hash::make( $request->password );
        $admin->save();
        if ( $request->role ) {
            $admin->syncRoles( $request->role );
        }

        return $this->redirectWithMessage( RedirectType::CREATE->value, 'admin.admin.index' );
    }

    public function edit( $id ) {
        abort_unless( checkAdminHasPermission( 'admin.edit' ), 403 );
        $admin = Admin::findOrFail( $id );
        $roles = Role::all();
        return view( 'admin.admin-list.edit_admin', compact( 'roles', 'admin' ) );
    }

    public function update( Request $request, $id ) {
        abort_unless( checkAdminHasPermission( 'admin.update' ), 403 );
        $admin = Admin::find( $id );
        $rules = [
            'name'     => 'required',
            'email'    => 'required|unique:admins,email,' . $admin->id,
            'password' => 'nullable|min:4',
            'status'   => 'required',
            'role'     => 'nullable|array',
        ];
        $customMessages = [
            'name.required'  => __( 'Name is required' ),
            'email.required' => __( 'Email is required' ),
            'email.unique'   => __( 'Email already exist' ),
            'password.min'   => __( 'Password Must be 4 characters' ),
            'role.array'     => __( 'You must select role' ),
        ];
        $this->validate( $request, $rules, $customMessages );

        $admin->name = $request->name;
        $admin->email = $request->email;
        $admin->status = $request->status;
        if ( $request->filled( 'password' ) ) {
            $admin->password = Hash::make( $request->password );
        }

        $admin->save();
        if ( $request->role ) {
            $admin->syncRoles( $request->role );
        }
        return $this->redirectWithMessage( RedirectType::UPDATE->value, 'admin.admin.index' );
    }

    public function destroy( $id ) {
        abort_unless( checkAdminHasPermission( 'admin.delete' ), 403 );
        $admin = Admin::findOrFail( $id );
        abort_if( $admin->id == 1, 403 );
        $admin->delete();
        return $this->redirectWithMessage( RedirectType::DELETE->value, 'admin.admin.index' );
    }

    public function changeStatus( $id ) {
        abort_unless( checkAdminHasPermission( 'admin.update' ), 403 );
        $admin = Admin::find( $id );
        $status = $admin->status == 'active' ? 'inactive' : 'active';
        $admin->status = $status;
        $admin->save();
        $notification = __( 'Updated Successfully' );
        return response()->json( [
            'success' => true,
            'message' => $notification,
        ] );
    }
}
