<?php

namespace App\Http\Controllers;

use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Exception;
use Session;

class SocialController extends Controller
{

    public function facebookRedirect()
    {
        return Socialite::driver('facebook')->redirect();
    }

    public function loginWithFacebook()
    {
        try {

            $user = Socialite::driver('facebook')->user();
            $isUser = User::where('email', $user->email)->first();

            if($isUser){
                if($isUser->provider_id=='' || $isUser->provider_id==NULL){
                    User::where('id', $isUser->id)->update([
                        'provider' => 'facebook',
                        'provider_id' => $user->id
                    ]);
                }
                Auth::login($isUser);

                return redirect()->route(
                    $user->role === 'admin' ? 'admin.dashboard' : 'user.dashboard'
                );
            }else{
                session()->flash('error', "No account associated with this Facebook account. Please register first.");
                return redirect()->intended(route('register'));
            }

        } catch (Exception $exception) {
            session()->flash('error', $exception->getMessage());
            return redirect()->intended(route('register'));
        }
    }
}
