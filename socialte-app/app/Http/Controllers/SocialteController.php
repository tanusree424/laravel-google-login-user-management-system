<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Exception;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\RedirectResponse|\Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }

    /**
     * Handle the Google authentication callback.
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public function googleAuthentication()
    {
        try {
            // Retrieve the user's information from Google
            $googleUser = Socialite::driver('google')->stateless()->user();

            // Check if the user already exists in the database
            $user = User::where('google_id', $googleUser->getId())->first();

            if ($user) {
                // User exists, log them in
                Auth::login($user);
            } else {
                // User does not exist, create a new record
                $user = User::create([
                    'name' => $googleUser->getName(),
                    'email' => $googleUser->getEmail(),
                    'password' => Hash::make('Password@1234'), // Consider prompting for a password change
                    'google_id' => $googleUser->getId(),
                    'role' => 0, // Default role, adjust as needed
                ]);

                // Log the new user in
                Auth::login($user);
            }

            // Redirect based on user role
            switch ($user->role) {
                case 1:
                    return redirect()->route('admin.dashboard');
                case 2:
                    return redirect()->route('superadmin.dashboard');
                default:
                    return redirect()->route('dashboard');
            }
        } catch (Exception $e) {
            // Handle exceptions (e.g., log the error, notify the user)
            // For now, redirect to the home page with an error message
            return redirect('/')->with('error', 'Authentication failed. Please try again.');
        }
    }
}
