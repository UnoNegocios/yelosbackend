<?php

namespace App\Http\Controllers\api\v2\user;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Http\Controllers\Controller;
use App\Http\Resources\user\CurrentUserResource;

class CurrentUser extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function __invoke(Request $request)
    {
        return New CurrentUserResource(Auth::user());
    }
}
