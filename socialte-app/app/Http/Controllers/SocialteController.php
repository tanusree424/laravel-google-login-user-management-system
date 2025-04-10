<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
class SocialteController extends Controller
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
 * @param NA
 * @return void
 */
public function googleAuthentication()
{
    try {
        $googleUser = Socialite::driver('google')->stateless()->user();
        $user = User::where('google_id',$googleUser->id)->first();
        if ($user) {
            Auth::login($user);
            return redirect()->route('dashboard');
    
        }else{
            $userData=User::create([
                'name'=>$googleUser->name,
                'email'=>$googleUser->email,
                'password'=>Hash::make('Password@1234'),
                'google_id'=>$googleUser->id
    
            ]);
            if ($userData) {
                Auth::login($userData);
                return redirect()->route('dashboard');
            }
        }
    } catch (Exception $e) {
        dd($e);
    }
   

}
}
