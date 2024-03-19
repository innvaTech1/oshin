<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Validation\ValidationException;

class UserAuthController extends Controller
{
    /**
     * Get the authenticated user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function profile(Request $request)
    {
        // Retrieve the authenticated user
        $user = $request->user();

        // Return user details
        return response()->json(['user' => $user], 200);
    }
    /**
     * Handle user logout.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function logout(Request $request)
    {
        // Revoke the user's token
        $request->user()->tokens()->delete();

        // Return success response
        return response()->json(['message' => 'Successfully logged out'], 200);
    }
    /**
     * Handle user registration.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function register(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:8|confirmed',
        ]);

        // Create new user
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Generate an API token for the newly registered user
        $token = $user->createToken('auth_token')->plainTextToken;

        // Return token and user details
        return response()->json([
            'access_token' => $token,
            'token_type' => 'Bearer',
            'user' => $user,
        ], 201);
    }
    /**
     * Handle user login.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
            'password' => 'required',
        ]);

        // Attempt to authenticate the user
        if (Auth::attempt($request->only('email', 'password'))) {
            // If authentication succeeds, generate an API token
            $user = Auth::user();
            $token = $user->createToken('auth_token')->plainTextToken;

            // Return token and user details
            return response()->json([
                'access_token' => $token,
                'token_type' => 'Bearer',
                'user' => $user,
            ]);
        }

        // If authentication fails, throw an exception
        throw ValidationException::withMessages([
            'email' => __('auth.failed'),
        ]);
    }
/**
 * Handle forgot password request.
 *
 * @param  \Illuminate\Http\Request  $request
 * @return \Illuminate\Http\JsonResponse
 * @throws \Illuminate\Validation\ValidationException
 */
    public function forgotPassword(Request $request)
    {
        // Validate incoming request data
        $request->validate(['email' => 'required|email']);

        // Send password reset link
        $status = Password::sendResetLink(
            $request->only('email')
        );

        // Check status and return appropriate response
        if ($status === Password::RESET_LINK_SENT) {
            return response()->json(['message' => 'Password reset link sent to your email']);
        } else {
            throw ValidationException::withMessages([
                'email' => [trans($status)],
            ]);
        }
    }

    /**
     * Handle password reset request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function resetPassword(Request $request)
    {
        // Validate incoming request data
        $request->validate([
            'email' => 'required|email',
            'token' => 'required|string',
            'password' => 'required|string|confirmed|min:8',
        ]);

        // Attempt to reset password
        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function ($user) use ($request) {
                $user->forceFill([
                    'password' => bcrypt($request->password),
                ])->save();
            }
        );

        // Check status and return appropriate response
        if ($status === Password::PASSWORD_RESET) {
            return response()->json(['message' => 'Password has been reset'], 201);
        } else {
            throw ValidationException::withMessages([
                'email' => [trans($status)],
            ]);
        }
    }

    /**
     * Update the authenticated user's profile.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function updateProfile(Request $request)
    {
        // Retrieve the authenticated user
        $user = $request->user();

        // Validate incoming request data
        $request->validate([
            'name' => 'required|string',
            'email' => 'required|email|unique:users,email,' . $user->id,
        ]);

        // Update user details
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();

        // Return success response
        return response()->json(['message' => 'Profile updated successfully']);
    }

}
