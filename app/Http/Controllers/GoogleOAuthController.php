<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Throwable;
use Illuminate\Support\Str;

class GoogleOAuthController extends Controller
{
    public function redirect()
    {
        return Socialite::driver('google')
            ->scopes(['openid', 'profile', 'email'])
            ->redirect();
    }

    public function callback()
    {
        try {
            $googleUser = Socialite::driver('google')->user();
        } catch (Throwable $exception) {
            report($exception);

            return redirect()
                ->route('login')
                ->withErrors([
                    'google' => 'Google sign-in failed. Please try again.',
                ]);
        }

        $googleId = $googleUser->getId();
        $email = $googleUser->getEmail();
        $isEmailVerified = filter_var(
            $googleUser->user['email_verified'] ?? false,
            FILTER_VALIDATE_BOOLEAN
        );

        if (! $googleId || ! $email || ! $isEmailVerified) {
            return redirect()
                ->route('login')
                ->withErrors([
                    'google' => 'A Google account with a verified email is required.',
                ]);
        }

        // First, find an account already linked to this Google identity.
        $user = User::where('google_id', $googleId)->first();

        if (! $user) {
            // Do not automatically link an existing password account
            // just because the email addresses match.
            if (User::where('email', $email)->exists()) {
                return redirect()
                    ->route('login')
                    ->withErrors([
                        'google' => 'An account with this email already exists. '
                            . 'Sign in with your password first, then link Google.',
                    ]);
            }

            $user = User::create([
                'name' => $googleUser->getName() ?: $email,
                'email' => $email,
                'google_id' => $googleId,
                'password' => Str::random(40),
                'email_verified_at' => now(),
            ]);
        }

        Auth::login($user);
        request()->session()->regenerate();

        return redirect()->intended(route('dashboard'));
    }
}