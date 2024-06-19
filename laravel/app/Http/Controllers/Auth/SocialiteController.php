<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;
use App\Models\User;
use Illuminate\Http\Request;

class SocialiteController extends Controller
{
    /**
     * Redirect the user to the Google authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToTwitter()
    {
        return Socialite::driver('twitter')->redirect();
    }

    /**
     * Obtain the user information from Google.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleTwitterCallback()
    {
        $twitterUser = Socialite::driver('twitter')->user();

        // Find or create the user in the database
        $user = User::firstOrCreate(
            [
                'provider' => 'twitter',
                'provider_id' => $twitterUser->getId()
            ],
            [
                'provider' => 'twitter',
                'provider_id' => $twitterUser->getId(),
                'name' => $twitterUser->getName(),
                'avatar' => $twitterUser->getAvatar(),
                'token' => $twitterUser->token,
            ]
        );

        // ログインさせる
        Auth::login($user, true);

        return redirect()->intended('/');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect('/');
    }
}
