<?php

namespace Modules\GlobalSetting\app\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\GlobalSetting\app\Models\EmailTemplate;
use Modules\GlobalSetting\app\Models\Setting;

class EmailSettingController extends Controller {
    public function email_config() {
        abort_unless( checkAdminHasPermission( 'setting.view' ), 403 );
        $templates = EmailTemplate::all();

        return view( 'globalsetting::email.email_config', compact( 'templates' ) );
    }

    public function update_email_config( Request $request ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        $request->validate( [
            'mail_sender_name'  => 'required',
            'mail_host'         => 'required',
            'mail_sender_email' => 'required',
            'mail_username'     => 'required',
            'mail_password'     => 'required',
            'mail_port'         => 'required',
            'mail_encryption'   => 'required',
        ], [
            'mail_sender_name.required'  => __( 'Sender name is required' ),
            'mail_host.required'         => __( 'Mail host is required' ),
            'mail_sender_email.required' => __( 'Email is required' ),
            'mail_username.required'     => __( 'Smtp username is required' ),
            'mail_password.unique'       => __( 'Smtp password is required' ),
            'mail_port.required'         => __( 'Mail port is required' ),
            'mail_encryption.required'   => __( 'Mail encryption is required' ),
        ] );

        Setting::where( 'key', 'mail_sender_name' )->update( ['value' => $request->mail_sender_name] );
        Setting::where( 'key', 'mail_host' )->update( ['value' => $request->mail_host] );
        Setting::where( 'key', 'mail_sender_email' )->update( ['value' => $request->mail_sender_email] );
        Setting::where( 'key', 'mail_username' )->update( ['value' => $request->mail_username] );
        Setting::where( 'key', 'mail_password' )->update( ['value' => $request->mail_password] );
        Setting::where( 'key', 'mail_port' )->update( ['value' => $request->mail_port] );
        Setting::where( 'key', 'mail_encryption' )->update( ['value' => $request->mail_encryption] );

        $setting_config = new GlobalSettingController();
        $setting_config->put_setting_cache();

        $notification = __( 'Update Successfully' );
        $notification = ['messege' => $notification, 'alert-type' => 'success'];

        return redirect()->back()->with( $notification );
    }

    public function edit_email_template( $id ) {
        abort_unless( checkAdminHasPermission( 'setting.view' ), 403 );
        $template = EmailTemplate::where( 'id', $id )->first();
        if ( $template->name == 'password_reset' ) {
            return view( 'globalsetting::email.template.password_reset', compact( 'template' ) );
        } elseif ( $template->name == 'contact_mail' ) {
            return view( 'globalsetting::email.template.contact_mail', compact( 'template' ) );
        } elseif ( $template->name == 'subscribe_notification' ) {
            return view( 'globalsetting::email.template.subscribe_notification', compact( 'template' ) );
        } elseif ( $template->name == 'user_verification' ) {
            return view( 'globalsetting::email.template.user_verification', compact( 'template' ) );
        } elseif ( $template->name == 'approved_refund' ) {
            return view( 'globalsetting::email.template.refund_approval', compact( 'template' ) );
        } elseif ( $template->name == 'new_refund' ) {
            return view( 'globalsetting::email.template.new_refund', compact( 'template' ) );
        } elseif ( $template->name == 'pending_wallet_payment' ) {
            return view( 'globalsetting::email.template.pending_wallet_payment', compact( 'template' ) );
        } elseif ( $template->name == 'approved_withdraw' ) {
            return view( 'globalsetting::email.template.approved_withdraw', compact( 'template' ) );
        } else {
            $notification = __( 'Something went wrong' );
            $notification = ['messege' => $notification, 'alert-type' => 'error'];

            return redirect()->back()->with( $notification );
        }

    }

    public function update_email_template( Request $request, $id ) {
        abort_unless( checkAdminHasPermission( 'setting.update' ), 403 );
        $rules = [
            'subject' => 'required',
            'message' => 'required',
        ];
        $customMessages = [
            'subject.required' => __( 'Subject is required' ),
            'message.required' => __( 'Message is required' ),
        ];

        $request->validate( $rules, $customMessages );

        $template = EmailTemplate::find( $id );
        if ( $template ) {
            $template->subject = $request->subject;
            $template->message = $request->message;
            $template->save();
            $notification = __( 'Updated Successfully' );
            $notification = ['messege' => $notification, 'alert-type' => 'success'];

            return redirect()->route( 'admin.email-configuration' )->with( $notification );
        } else {
            $notification = __( 'Something went wrong' );
            $notification = ['messege' => $notification, 'alert-type' => 'error'];

            return redirect()->back()->with( $notification );
        }
    }
}
