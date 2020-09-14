<?php

namespace App\Http\Controllers\Api\Auth;

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\Controller;

use App\Http\Response;

class LogoutController extends Controller
{
    public function __invoke()
    {
        Auth::user()->token()->revoke();

        return Response::send([
            'error' => false,
            'message' => 'User successful logged out'
        ], 'SUCCESS');
    }
}
