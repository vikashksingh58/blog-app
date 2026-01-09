<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Exception;
use Session;

class GoogleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function redirectToGoogle()
    {
        return Socialite::driver('google')->stateless()->redirect();
    }

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function handleGoogleCallback()
    {
        try {

            $user = Socialite::driver('google')->stateless()->user();

            $finduser = User::where('email', $user->email)->first();
            if($finduser){
                if($finduser->provider_id=='' || $finduser->provider_id==NULL){
                    User::where('id', $finduser->id)->update([
                        'provider' => 'google',
                        'provider_id' => $user->id
                    ]);
                }
                Auth::login($finduser);

                return redirect()->intended(route('dashboard'));
            }else{
                session()->flash('error', "No account associated with this Google account. Please register first.");
                return redirect()->intended(route('register'));
            }

        } catch (Exception $e) {
            session()->flash('error', $e->getMessage());
            return redirect()->intended(route('register'));
        }
    }
}
