<?php

namespace App\Traits;

use App\Enums\UserStatus;
use App\Models\User;
use Exception;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Str;

trait NewUserCreateTrait
{
    use MailSenderTrait;

    private function createNewUser($callbackUser, $provider_name, $user)
    {
        if (!$user) {
            $password = Str::random(10);
            $user = User::create([
                'name' => $callbackUser->name,
                'email' => $callbackUser->email,
                'status' => UserStatus::ACTIVE->value,
                'is_banned' => UserStatus::UNBANNED->value,
                'image' => $callbackUser->getAvatar(),
                'email_verified_at' => now(),
                'password' => Hash::make($password),
                'verification_token' => Str::random(100),
            ]);
            try {
                $this->socialLoginDefaultPasswordJob($callbackUser, $user, $password);
            } catch (Exception $e) {
                session(['error' => $e->getMessage()]);
                if (app()->isLocal()) {
                    Log::error($e);
                }
            }
        }

        $socialite = $user->socialite()->create([
            'provider_name' => $provider_name,
            'provider_id' => $callbackUser->getId(),
            'access_token' => $callbackUser->token ?? null,
            'refresh_token' => $callbackUser->refreshToken ?? null,
        ]);

        return $socialite;
    }
}
