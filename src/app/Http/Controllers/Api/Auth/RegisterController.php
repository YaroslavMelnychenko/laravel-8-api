<?php

namespace App\Http\Controllers\Api\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\Auth\RegisterRequest;
use App\Http\Response;

use App\Models\User;

class RegisterController extends Controller
{
    public function __invoke(RegisterRequest $request)
    {
        $user = User::create(array_merge(
            $request->only('email'),
            ['password' => bcrypt($request->password)]
        ));

        return Response::send([
            'error' => false,
            'message' => $user
        ], 'SUCCESS');
    }
}
