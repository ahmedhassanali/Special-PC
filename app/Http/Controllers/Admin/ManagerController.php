<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserStoreRequest;
use App\Http\Requests\UserUpdateRequest;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Agent;
use App\Models\UserRole;
use App\Models\UserLog;
use App\Services\ImageService;
use Illuminate\Support\Facades\Hash;

class ManagerController extends Controller {
    // index

    public function index() {
        $users = User::get();
        return view( 'admin.manager.index', compact( 'users' ) );
    }

    public function user_activity() {
        $logs = UserLog::orderBy('id','DESC')->paginate(10);
        return view( 'admin.manager.activity.index', compact( 'logs' ) );
    }

    // create

    public function create() {
        $roles = UserRole::get();
        return view( 'admin.manager.form', compact( 'roles' ) );
    }

    // edit

    public function edit( $id ) {
        $user = User::find( $id );
        $roles = UserRole::get();

        return view( 'admin.manager.form', compact( 'user', 'roles' ) );
    }

    // save user notification & checkboxes

    public function save( Request $request, $id = null ) {
        $user = User::find( $id );
        if ( $user ) {
            $user->update( $request->all() );
        }
        return redirect()->route( 'admin.manager.index' );
    }

    // updateOrCreate

    public function updateOrCreate( Request $request, $id = null ) {
        $user = User::find( $id );
        $request->merge( [ 'status' => 1 ] );

        if ( isset( $request->password ) ) {
            $request->merge( [ 'password' => Hash::make( $request->password ) ] );
        }

        if (isset($request['photo'])) {

            $oldImage = null;
            if(isset($user->image))
                $oldImage =  $user->image;
            $request['image'] = ImageService::update($request['photo'] , 'users/' ,$oldImage);
        }

        if ( !$user ) {
            $user = new User();
            $check = User::where( 'email', $request->email )->first();
            if ( $check ) {
                return redirect()->back()->with( 'error', 'Email is already Taken' );
            }
            $user->create( $request->all() );
        } else {
            $user->update( $request->all() );
        }

        return redirect()->route( 'admin.manager.index' )->with('success', 'User_updated_successfully');
    }


    // delete

    public function delete( $id ) {
        $user = User::find( $id );
        $user->delete();
        return redirect()->route( 'admin.manager.index' );
    }

    // approve

    public function approve( $id ) {
        $user = User::find( $id );
        $user->status = 1;
        $user->save();

        return redirect()->route( 'admin.manager.index' );
    }

    // desactivate

    public function desactivate( $id ) {
        $user = User::find( $id );
        $user->status = 0;
        $user->save();
        return redirect()->route( 'admin.manager.index' );
    }

    // role

    public function roles() {
        $roles = UserRole::get();
        return view( 'admin.manager.role.index', compact( 'roles' ) );
    }

    // role create

    public function roleCreate() {
        return view( 'admin.manager.role.form' );
    }

    // role edit

    public function roleEdit( $id ) {
        $role = UserRole::find( $id );
        return view( 'admin.manager.role.form', compact( 'role' ) );
    }

    // role updateOrCreate

    public function roleUpdateOrCreate( Request $request, $id = null ) {
        $role = UserRole::find( $id );
        // coverting the array to string
        $request->merge( [ 'permission' => implode( ',', $request->permission ) ] );

        if ( !$role ) {
            $role = new UserRole();
            $role->create( $request->all() );
        } else {
            $role->update( $request->all() );
        }

        return redirect()->route( 'admin.manager.role' );
    }

    // role delete

    public function roleDelete( $id ) {
        $role = UserRole::find( $id );
        $role->delete();

        return redirect()->route( 'admin.manager.role.index' );
    }

}
