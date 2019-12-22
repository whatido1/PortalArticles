<?php

namespace App\Http\Controllers;

use App\User;
use App\Models\Role;
use Illuminate\Http\Request;
use Laravel\Socialite\Facades\Socialite;

class SocialController extends Controller
{
    /**
     * Redirect handle for socialite
     * 
     * @param string $provider
     * @return \Laravel\Socialite\Contracts\Provider
     */
    public function redirect($provider)
    {
        return Socialite::driver($provider)->redirect();
    }

    /**
     * Callback handle for socialite
     * 
     * @param string $provider
     */
    public function callback($provider)
    {
        $getInfo = Socialite::driver($provider)->user();

        $user = $this->createUser($getInfo, $provider);
        auth()->login($user);
        $user = Auth::user();
        if($user->role->role === 'user') {
            return redirect()->to('/home');
        } else {
            return \redirect()->route('article.index');
        }
    }

    /**
     * Get user or create if not exists
     * @param \Laravel\Socialite\Contracts\User $getInfo
     * @param String $provider
     * 
     * @return \App\User
     */
    private function createUser($getInfo, $provider)
    {
        $user = User::where('provider_id', $getInfo->id)->first();

        if(! $user) {
            $user = User::create([
                'name' => $getInfo->name,
                'email' => $getInfo->email,
                'provider' => $provider,
                'photo' => $getInfo->getAvatar(),
                'provider_id' => $getInfo->id,
                'role_id' => Role::where('role', 'user')->first()->id,
                'email_verified_at' => now(),
            ]);
        }
        return $user;
    }
}
