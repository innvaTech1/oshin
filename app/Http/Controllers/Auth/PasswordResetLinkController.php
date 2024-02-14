<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\GetGlobalInformationTrait;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Password;
use Illuminate\View\View;
use Str;

class PasswordResetLinkController extends Controller
{
    use GetGlobalInformationTrait;

    public function create(): View
    {
        return view('frontend.auth.forgot');
    }

    /**
     * Handle an incoming password reset link request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => ['required', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $request->only('email')
        );

        return $status == Password::RESET_LINK_SENT
            ? back()->with('status', __($status))
            : back()->withInput($request->only('email'))
            ->withErrors(['email' => __($status)]);
    }

    public function custom_forget_password(Request $request)
    {

        $request->validate([
            'email'                => ['required', 'email'],
        ], [
            'email.required'                => __('Email is required'),
        ]);

        $user = User::where('email', $request->email)->first();

        if ($user) {

            $forgot_pass_token = Str::random(100);

            $user->forget_password_token = $forgot_pass_token;
            $user->save();

            Mail::send('frontend.emails.password-reset', [
                'name'  => $user->name,
                'token' => $forgot_pass_token
            ], function ($message) use ($request,$user) {
                $message->to($request->email, $user->name);
                $message->subject('Reset Password');
            });


            $notification = __('A password reset link has been send to your mail');
            $notification = array('messege' => $notification, 'alert-type' => 'success');
            return redirect(route('resetEmail'))->with($notification);
        } else {
            $notification = __('Email does not exist');
            $notification = array('messege' => $notification, 'alert-type' => 'error');
            return redirect()->back()->with($notification);
        }
    }
}
