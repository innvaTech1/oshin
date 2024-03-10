<?php

namespace Modules\NewsLetter\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\NewsLetter\app\Jobs\NewsLetterVerifyJob;
use Modules\NewsLetter\app\Models\NewsLetter;
use Str;

class NewsLetterController extends Controller
{
    public function newsletter_request(Request $request)
    {

        $request->validate([
            'email' => 'required|unique:news_letters',
        ], [
            'email.required' => __('Email is required'),
            'email.unique' => __('Email already exist'),
        ]);

        $newsletter = new NewsLetter();
        $newsletter->email = $request->email;
        $newsletter->verify_token = Str::random(100);
        $newsletter->save();

        dispatch(new NewsLetterVerifyJob($newsletter));

        return response()->json(['message' => __('A verification link has been send to your email, please verify it and getting our newsletter')]);

    }

    public function newsletter_verification($token)
    {
        $newsletter = NewsLetter::where('verify_token', $token)->first();

        if ($newsletter) {
            $newsletter->verify_token = null;
            $newsletter->status = 'verified';
            $newsletter->save();

            $notification = __('Newsletter verification successfully');
            $notification = ['messege' => $notification, 'alert-type' => 'success'];

            return redirect()->route('home')->with($notification);

        } else {
            $notification = __('Newsletter verification faild for invalid token');
            $notification = ['messege' => $notification, 'alert-type' => 'error'];

            return redirect()->route('home')->with($notification);
        }

    }
}
