<?php

namespace App\Http\Controllers\api\v2\user;

use Illuminate\Http\Request;
use App\Models\User;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\user\CurrentUserResource;

class LoginUser extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        $login = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if( !Auth::attempt($login)) {
            return response(['message' => 'Invalid login credentials.']);
        }
        $accessToken = Auth::user()->createToken('authToken')->accessToken;

        return response(['user' => New CurrentUserResource(Auth::user()), 'access_token' => $accessToken]);
    }
}
