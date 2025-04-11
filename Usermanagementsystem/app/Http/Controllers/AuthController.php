<?php

namespace App\Http\Controllers;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Auth;
use Laravel\Socialite\Facades\Socialite;
class AuthController extends Controller
{
    public function Register(){
        return view("Authentication.Register");
    }
    public function login()
    {
        return view('Authentication.Login');
    }

    public function post_register(Request $request)
{
    // Validate the input
    $validatedData = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email',
        'password' => 'required|string|min:6',
        'is_role' => 'required' // Adjust the rule based on your app's logic
    ]);

    // Create and save the user
    $user = new User;
    $user->name = trim($validatedData['name']);
    $user->email = trim($validatedData['email']);
    $user->password = Hash::make($validatedData['password']);
    $user->is_role = $validatedData['is_role']; // Assuming this column exists in your `users` table
    $user->google_id = 0000;

    $user->remember_token = Str::random(50);
    // $user->google_id = null;
    $user->save();

    // Redirect on success
    if ($user) {
        return redirect("login")->with("success","Registration Successful");
    }

    // Optional: Handle failure case
    return back()->with('error', 'Registration failed. Please try again.');
}
    public function post_login(Request $request){
        if (Auth::attempt(['email' => $request->email, 'password' => $request->password],true)) 
        {
            if (Auth::User()->is_role == "2") {
                //echo  "Super Admin"; die();
                 return redirect()->intended('/superadmin/dashboard');
            }
            elseif (Auth::User()->is_role == "1") {
                echo  "Admin"; die();
                // return redirect()->intended('/admin/dashboard');
            }
            elseif (Auth::User()->is_role == "0") {
                // echo "User"; die();
                return redirect()->intended('/user/dashboard');
            }
            else{
                 return redirect('login')->with('error', 'No Available Mail...',"Please Check");
            }
        }
        else
        {
            return redirect()->back()->with('error','please Enter Correct Credentials');
        }

    }
    public function Adminlogout(Request $request)
    {
        if (Auth::check()) {
            $user = Auth::User();
        
            if ($user->is_role == 1 || $user->is_role == 2) {
                Auth::logout();
                $request->session()->invalidate();
                $request->session()->regenerateToken();
        
                return redirect('/login')->with('success', 'You have been logged out.');
            }
        
            return redirect()->back()->with('error', 'You are not allowed to logout via admin route.');
        }
        
        return redirect('/login');
    }
    public function googleLogin()
    {
        return Socialite::driver('google')->redirect();
    }
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
                    'google_id' =>$googleUser->getId() ?? null,
                    'is_role' => 0, // Default role, adjust as needed
                ]);

                // Log the new user in
                Auth::login($user);
                // dd($googleUser);
            }

            // Redirect based on user role
            switch ($user->is_role) {
                case 1:
                    return redirect()->route('superadmin.dashboard');
                case 2:
                    return redirect()->route('superadmin.dashboard');
                default:
                    return redirect()->route('userdashboard');
            }
        } catch (Exception $e) {
            // Handle exceptions (e.g., log the error, notify the user)
            // For now, redirect to the home page with an error message
            return redirect('/')->with('error', 'Authentication failed. Please try again.');
        }

    }
}

