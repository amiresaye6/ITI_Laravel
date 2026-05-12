<?php
namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Str;

class WebSocialAuthController extends Controller
{
    public function redirect($provider)
    {
        // So clean. It automatically uses the URL from config/services.php
        return Socialite::driver($provider)->redirect();
    }

    public function callback($provider)
    {
        try {
            $driver = Socialite::driver($provider);
            
            // Disable SSL verification for local development (fixes cURL error 60)
            if (app()->environment('local')) {
                $driver->setHttpClient(new \GuzzleHttp\Client(['verify' => false]));
            }

            $socialUser = $driver->user();
        } catch (\Exception $e) {
            return redirect('/login')->withErrors(['error' => 'Login cancelled or failed. Reason: ' . $e->getMessage()]);
        }

        // Find existing user or create a new one
        $user = User::where($provider . '_id', $socialUser->getId())
            ->orWhere('email', $socialUser->getEmail())
            ->first();

        if ($user) {
            $user->update([
                $provider . '_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
            ]);
        } else {
            $user = User::create([
                'name' => $socialUser->getName() ?? $socialUser->getNickname(),
                'email' => $socialUser->getEmail(),
                $provider . '_id' => $socialUser->getId(),
                'avatar' => $socialUser->getAvatar(),
                'password' => bcrypt(Str::random(24)), // highly secure random password
            ]);
        }

        // THIS IS THE MAGIC LINE FOR BREEZE!
        Auth::login($user);

        return redirect('/dashboard');
    }
}