<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Jobs\SendVerifyMailToUser;
use App\Models\User;
use App\Rules\CustomRecaptcha;
use App\Traits\GetGlobalInformationTrait;
use Cache;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\View\View;
use Str;

class RegisteredUserController extends Controller {
    use GetGlobalInformationTrait;

    public function create(): View {
        return view( 'frontend.auth.register' );
    }

    public function store( Request $request ): RedirectResponse {
        $setting = Cache::get( 'setting' );

        $request->validate( [
            'name'                 => ['required', 'string', 'max:255'],
            'email'                => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password'             => ['required', 'confirmed', 'min:4', 'max:100'],
            'g-recaptcha-response' => $setting->recaptcha_status == 'active' ? ['required', new CustomRecaptcha()] : '',
        ], [
            'name.required'                 => __( 'Name is required' ),
            'email.required'                => __( 'Email is required' ),
            'email.unique'                  => __( 'Email already exist' ),
            'password.required'             => __( 'Password is required' ),
            'password.confirmed'            => __( 'Confirm password does not match' ),
            'password.min'                  => __( 'You have to provide minimum 4 character password' ),
            'g-recaptcha-response.required' => trans( 'Please complete the recaptcha to submit the form' ),
        ] );

        $user = User::create( [
            'name'               => $request->name,
            'email'              => $request->email,
            'status'             => 'active',
            'is_banned'          => 'no',
            'password'           => Hash::make( $request->password ),
            'verification_token' => Str::random( 100 ),
        ] );

        dispatch( new SendVerifyMailToUser( 'single_user', $user ) );

        $notification = __( 'A varification link has been send to your mail, please verify and enjoy our service' );
        $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
        return redirect()->back()->with( $notification );

    }

    public function custom_user_verification( $token ) {
        $user = User::where( 'verification_token', $token )->first();
        if ( $user ) {

            if ( $user->email_verified_at != null ) {
                $notification = __( 'Email already verified' );
                $notification = array( 'messege' => $notification, 'alert-type' => 'error' );
                return redirect()->route( 'login' )->with( $notification );
            }

            $user->email_verified_at = date( 'Y-m-d H:i:s' );
            $user->verification_token = null;
            $user->save();

            $notification = __( 'Verification Successfully, please try to login now' );
            $notification = array( 'messege' => $notification, 'alert-type' => 'success' );
            return redirect()->route( 'login' )->with( $notification );
        } else {
            $notification = __( 'Invalid token' );
            $notification = array( 'messege' => $notification, 'alert-type' => 'error' );
            return redirect()->route( 'register' )->with( $notification );
        }
    }
}
