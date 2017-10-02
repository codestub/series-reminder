<?php

namespace App\Http\Controllers;

use JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Requests\RegistrationRequest;

class AuthController extends Controller
{
    public function register(RegistrationRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(['token' => $token], 200);
    }

    public function authenticate()
    {
        $credentials = request()->only('email', 'password');

        try {
            $token = JWTAuth::attempt($credentials);

            if (!$token) {
                return response()->json(['error' => 'invalid_credentials'], 401);
            }
        }
        catch(JWTException $e) {
            return response()->json(['error' => 'something_went_wrong'], 500);
        }

        return response()->json(['token' => $token], 200);
    }
}
