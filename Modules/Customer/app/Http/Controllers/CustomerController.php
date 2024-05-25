<?php

namespace Modules\Customer\app\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Traits\GetGlobalInformationTrait;
use App\Traits\MailSenderTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use Modules\Customer\app\Jobs\SendBulkEmailToUser;
use Modules\Customer\app\Jobs\SendUserBannedMailJob;
use Modules\Customer\app\Models\BannedHistory;

class CustomerController extends Controller
{
    use GetGlobalInformationTrait, MailSenderTrait;

    public function index(Request $request)
    {
        abort_unless(checkAdminHasPermission('customer.view'), 403);

        $query = User::query();

        $query->when($request->filled('keyword'), function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->keyword . '%')
                ->orWhere('email', 'like', '%' . $request->keyword . '%')
                ->orWhere('phone', 'like', '%' . $request->keyword . '%')
                ->orWhere('address', 'like', '%' . $request->keyword . '%');
        });

        $query->when($request->filled('verified'), function ($q) use ($request) {
            $q->where(function ($query) use ($request) {
                if ($request->verified == 1) {
                    $query->whereNotNull('email_verified_at');
                } elseif ($request->verified == 0) {
                    $query->whereNull('email_verified_at');
                }
            });
        });

        $query->when($request->filled('banned'), function ($q) use ($request) {
            $q->where(function ($query) use ($request) {
                if ($request->banned == 1) {
                    $query->where('is_banned', 'yes');
                } elseif ($request->banned == 0) {
                    $query->where('is_banned', 'no');
                }
            });
        });
        $query->when($request->filled('order_by'), function ($q) use ($request) {
            $q->orderBy('id', $request->order_by == 1 ? 'asc' : 'desc');
        });

        if ($request->filled('par-page')) {
            $users = $request->get('par-page') == 'all' ? $query->get() : $query->paginate($request->get('par-page'))->withQueryString();
        } else {
            $users = $query->paginate()->withQueryString();
        }

        return view('customer::all_customer')->with([
            'users' => $users,
        ]);
    }

    public function active_customer(Request $request)
    {
        abort_unless(checkAdminHasPermission('customer.view'), 403);

        $query = User::query();
        $query->where(['status' => 'active', 'is_banned' => 'no'])->where('email_verified_at', '!=', null);

        $query->when($request->filled('keyword'), function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->keyword . '%')
                ->orWhere('email', 'like', '%' . $request->keyword . '%')
                ->orWhere('phone', 'like', '%' . $request->keyword . '%')
                ->orWhere('address', 'like', '%' . $request->keyword . '%');
        });

        $query->when($request->filled('order_by'), function ($q) use ($request) {
            $q->orderBy('id', $request->order_by == 1 ? 'asc' : 'desc');
        });

        if ($request->filled('par-page')) {
            $users = $request->get('par-page') == 'all' ? $query->get() : $query->paginate($request->get('par-page'))->withQueryString();
        } else {
            $users = $query->paginate()->withQueryString();
        }

        return view('customer::active_customer')->with([
            'users' => $users,
        ]);
    }

    public function non_verified_customers(Request $request)
    {
        abort_unless(checkAdminHasPermission('customer.view'), 403);

        $query = User::query();
        $query->where('email_verified_at', null);

        $query->when($request->filled('keyword'), function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->keyword . '%')
                ->orWhere('email', 'like', '%' . $request->keyword . '%')
                ->orWhere('phone', 'like', '%' . $request->keyword . '%')
                ->orWhere('address', 'like', '%' . $request->keyword . '%');
        });
        $query->when($request->filled('banned'), function ($q) use ($request) {
            $q->where(function ($query) use ($request) {
                if ($request->banned == 1) {
                    $query->where('is_banned', 'yes');
                } elseif ($request->banned == 0) {
                    $query->where('is_banned', 'no');
                }
            });
        });
        $query->when($request->filled('order_by'), function ($q) use ($request) {
            $q->orderBy('id', $request->order_by == 1 ? 'asc' : 'desc');
        });

        if ($request->filled('par-page')) {
            $users = $request->get('par-page') == 'all' ? $query->get() : $query->paginate($request->get('par-page'))->withQueryString();
        } else {
            $users = $query->paginate()->withQueryString();
        }

        return view('customer::non_verified_customer')->with([
            'users' => $users,
        ]);
    }

    public function banned_customers(Request $request)
    {
        abort_unless(checkAdminHasPermission('customer.view'), 403);

        $query = User::query();
        $query->where('is_banned', 'yes');

        $query->when($request->filled('keyword'), function ($q) use ($request) {
            $q->where('name', 'like', '%' . $request->keyword . '%')
                ->orWhere('email', 'like', '%' . $request->keyword . '%')
                ->orWhere('phone', 'like', '%' . $request->keyword . '%')
                ->orWhere('address', 'like', '%' . $request->keyword . '%');
        });

        $query->when($request->filled('verified'), function ($q) use ($request) {
            $q->where(function ($query) use ($request) {
                if ($request->verified == 1) {
                    $query->whereNotNull('email_verified_at');
                } elseif ($request->verified == 0) {
                    $query->whereNull('email_verified_at');
                }
            });
        });

        $query->when($request->filled('order_by'), function ($q) use ($request) {
            $q->orderBy('id', $request->order_by == 1 ? 'asc' : 'desc');
        });

        if ($request->filled('par-page')) {
            $users = $request->get('par-page') == 'all' ? $query->get() : $query->paginate($request->get('par-page'))->withQueryString();
        } else {
            $users = $query->paginate()->withQueryString();
        }

        return view('customer::banned_customer')->with([
            'users' => $users,
        ]);
    }

    public function show($id)
    {
        abort_unless(checkAdminHasPermission('customer.view'), 403);

        $user = User::findOrFail($id);

        $banned_histories = BannedHistory::where('user_id', $id)->orderBy('id', 'desc')->get();

        return view('customer::customer_show')->with([
            'user'             => $user,
            'banned_histories' => $banned_histories,
        ]);
    }

    public function update(Request $request, $id)
    {
        abort_unless(checkAdminHasPermission('customer.update'), 403);

        $rules = [
            'name'    => 'required',
        ];
        $customMessages = [
            'name.required'    => __('Name is required')
        ];
        $request->validate($rules, $customMessages);

        $user = User::findOrFail($id);
        $user->name = $request->name;
        $user->phone = $request->phone;
        $user->address = $request->address;
        $user->save();

        $notification = __('Updated Successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function password_change(Request $request, $id)
    {
        abort_unless(checkAdminHasPermission('customer.update'), 403);

        $rules = [
            'password' => 'required|min:4|confirmed',
        ];
        $customMessages = [
            'password.required'  => __('Password is required'),
            'password.min'       => __('Password minimum 4 character'),
            'password.confirmed' => __('Confirm password does not match'),
        ];
        $this->validate($request, $rules, $customMessages);

        $user = User::findOrFail($id);

        $user->password = Hash::make($request->password);
        $user->save();

        $notification = __('Password change successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function send_banned_request(Request $request, $id)
    {
        abort_unless(checkAdminHasPermission('customer.update'), 403);

        $rules = [
            'subject'     => 'required|max:255',
            'description' => 'required',
        ];
        $customMessages = [
            'subject.required'     => __('Subject is required'),
            'description.required' => __('Description is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $user = User::findOrFail($id);
        if ($user->is_banned == 'yes') {
            $user->is_banned = 'no';
            $user->save();

            $banned = new BannedHistory();
            $banned->user_id = $id;
            $banned->subject = $request->subject;
            $banned->reasone = 'for_unbanned';
            $banned->description = $request->description;
            $banned->save();
        } else {
            $user->is_banned = 'yes';
            $user->save();

            $banned = new BannedHistory();
            $banned->user_id = $id;
            $banned->subject = $request->subject;
            $banned->reasone = 'for_banned';
            $banned->description = $request->description;
            $banned->save();
        }

        dispatch(new SendUserBannedMailJob($request->description, $request->subject, $user));

        $notification = __('Banned request successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function send_verify_request(Request $request, $id)
    {

        $user = User::findOrFail($id);
        $user->verification_token = Str::random(100);
        $user->save();

        $this->sendVerifyMailToUserFromTrait('single_user', $user);

        $notification = __('A varification link has been send to user mail');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function send_verify_request_to_all(Request $request)
    {

        $this->sendVerifyMailToUserFromTrait('all_user');

        $notification = __('A varification link has been send to user mail');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function send_mail_to_customer(Request $request, $id)
    {
        $rules = [
            'subject'     => 'required|max:255',
            'description' => 'required',
        ];
        $customMessages = [
            'subject.required'     => __('Subject is required'),
            'description.required' => __('Description is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        $user = User::findOrFail($id);

        dispatch(new SendBulkEmailToUser($request->subject, $request->description, 'single_user', $user));

        $notification = __('Mail send to customer successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function send_bulk_mail()
    {
        abort_unless(checkAdminHasPermission('customer.bulk.mail'), 403);

        return view('customer::send_bulk_mail');
    }

    public function send_bulk_mail_to_all(Request $request)
    {
        abort_unless(checkAdminHasPermission('customer.bulk.mail'), 403);

        $rules = [
            'subject'     => 'required|max:255',
            'description' => 'required',
        ];

        $customMessages = [
            'subject.required'     => __('Subject is required'),
            'description.required' => __('Description is required'),
        ];

        $this->validate($request, $rules, $customMessages);

        dispatch(new SendBulkEmailToUser($request->subject, $request->description, 'all_user'));

        $notification = __('Mail send to customer successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with($notification);
    }

    public function destroy($id)
    {
        abort_unless(checkAdminHasPermission('customer.delete'), 403);

        $user = User::findOrFail($id);
        if ($user->image) {
            if (File::exists(public_path($user->image))) {
                unlink(public_path($user->image));
            }
        }

        $user->delete();

        $notification = __('Customer deleted successfully');
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->route('admin.active-customers')->with($notification);
    }
}
