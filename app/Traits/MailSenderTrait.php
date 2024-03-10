<?php

namespace App\Traits;

use App\Jobs\SendVerifyMailToUser;
use App\Jobs\SocialLoginDefaultPasswordJob;
use App\Jobs\UserForgetPasswordJob;
use App\Mail\SocialLoginDefaultPasswordMail;
use App\Mail\UserForgetPassword;
use App\Mail\UserRegistration;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Modules\GlobalSetting\app\Models\EmailTemplate;

trait MailSenderTrait
{
    private static function isQueable(): bool
    {
        return getSettingStatus('is_queable');
    }

    private function sendVerifyMailToUserFromTrait($user_type, $user_info = null)
    {
        if (self::setMailConfig()) {
            try {
                if (self::isQueable()) {
                    dispatch(new SendVerifyMailToUser($user_type, $user_info = null));
                } else {
                    if ($user_type == 'all_user') {
                        $users = User::where('email_verified_at', null)->orderBy('id', 'desc')->get();
                        foreach ($users as $index => $user) {
                            $user->verification_token = \Illuminate\Support\Str::random(100);
                            $user->save();

                            try {
                                $template = EmailTemplate::where('name', 'user_verification')->first();
                                $subject = $template->subject;
                                $message = $template->message;
                                $message = str_replace('{{user_name}}', $user->name, $message);

                                Mail::to($user->email)->send(new UserRegistration($message, $subject, $user));
                            } catch (Exception $ex) {
                                if (app()->isLocal()) {
                                    Log::error($ex->getMessage());
                                }
                            }
                        }
                    } else {
                        try {
                            $template = EmailTemplate::where('name', 'user_verification')->first();
                            $subject = $template->subject;
                            $message = $template->message;
                            $message = str_replace('{{user_name}}', $user_info->name, $message);

                            Mail::to($user_info->email)->send(new UserRegistration($message, $subject, $user_info));
                        } catch (Exception $ex) {
                            if (app()->isLocal()) {
                                Log::error($ex->getMessage());
                            }
                        }
                    }
                }

                return true;
            } catch (Exception $th) {
                if (app()->isLocal()) {
                    Log::error($th->getMessage());
                }

                return false;
            }
        }

        return false;
    }

    private function sendUserForgetPasswordFromTrait($from_user, $mail_template_path = 'auth')
    {
        if (self::setMailConfig()) {
            try {
                if (self::isQueable()) {
                    dispatch(new UserForgetPasswordJob($from_user, $mail_template_path));
                } else {
                    try {
                        $template = EmailTemplate::where('name', 'password_reset')->first();
                        $subject = $template->subject;
                        $message = $template->description;
                        $message = str_replace('{{user_name}}', $from_user->name, $message);
                        Mail::to($from_user->email)->send(new UserForgetPassword($message, $subject, $from_user, $mail_template_path));
                    } catch (Exception $ex) {
                        if (app()->isLocal()) {
                            Log::error($ex->getMessage());
                        }
                    }
                }

                return true;
            } catch (Exception $th) {
                if (app()->isLocal()) {
                    Log::error($th->getMessage());
                }

                return false;
            }
        }

        return false;
    }

    private function sendSocialLoginDefaultPasswordFromTrait($user, $password)
    {
        if (self::setMailConfig()) {
            try {
                if (self::isQueable()) {
                    dispatch(new SocialLoginDefaultPasswordJob($user, $password));
                } else {
                    try {
                        Mail::to($this->user->email)->send(new SocialLoginDefaultPasswordMail($user, $password));
                    } catch (Exception $ex) {
                        if (app()->isLocal()) {
                            Log::error($ex->getMessage());
                        }
                    }
                }

                return true;
            } catch (Exception $th) {
                if (app()->isLocal()) {
                    Log::error($th->getMessage());
                }

                return false;
            }
        }

        return false;
    }

    private static function setMailConfig()
    {
        try {
            $email_setting = Cache::get('setting');

            $mailConfig = [
                'transport' => 'smtp',
                'host' => $email_setting->mail_host,
                'port' => $email_setting->mail_port,
                'encryption' => $email_setting->mail_encryption,
                'username' => $email_setting->mail_username,
                'password' => $email_setting->mail_password,
                'timeout' => null,
            ];

            config(['mail.mailers.smtp' => $mailConfig]);
            config(['mail.from.address' => $email_setting->mail_sender_email]);
            config(['mail.from.name' => $email_setting->mail_sender_name]);

            return true;
        } catch (\Throwable $th) {
            if (app()->isLocal()) {
                Log::error($th->getMessage());
            }

            return false;
        }
    }
}
