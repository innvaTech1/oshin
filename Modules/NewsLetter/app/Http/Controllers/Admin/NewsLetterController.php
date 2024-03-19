<?php

namespace Modules\NewsLetter\app\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\NewsLetter\app\Jobs\SendMailToNewsletterJob;
use Modules\NewsLetter\app\Models\NewsLetter;

class NewsLetterController extends Controller
{
    public function index()
    {
        abort_unless(checkAdminHasPermission('newsletter.view'), 403);
        $newsletters = NewsLetter::orderBy('id', 'desc')->where('status', 'verified')->get();

        return view('newsletter::index', ['newsletters' => $newsletters]);
    }

    public function create()
    {
        abort_unless(checkAdminHasPermission('newsletter.mail'), 403);

        return view('newsletter::create');
    }

    public function destroy($id)
    {
        abort_unless(checkAdminHasPermission('newsletter.delete'), 403);
        $newsletter = NewsLetter::find($id);
        $newsletter->delete();

        $notification = __('Deleted successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function store(Request $request)
    {
        abort_unless(checkAdminHasPermission('newsletter.mail'), 403);
        $request->validate([
            'subject' => 'required',
            'description' => 'required',
        ], [
            'subject.required' => __('Subject is required'),
            'description.required' => __('Description is required'),
        ]);

        dispatch(new SendMailToNewsletterJob($request->subject, $request->description));

        $notification = __('Mail send successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }
}
