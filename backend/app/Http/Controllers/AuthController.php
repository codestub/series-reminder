<?php

namespace App\Http\Controllers;

use Auth;
use JWTAuth;
use JWTFactory;
use App\User;
use Carbon\Carbon;
use App\Events\UserRegistration;
use App\Events\UserConfirmed;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\AuthenticationRequest;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('register', 'authenticate', 'confirm');
    }

    public function register(RegistrationRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password),
            'confirmation_token' => str_random(20)
        ]);

        event(new UserRegistration($user));

        return response()->json(['message' => 'Please check your email to confirm your account'], 200);
    }

    public function authenticate(AuthenticationRequest $request)
    {
        $token = JWTAuth::attempt($request->only('email', 'password'));

        if (!$token) {
            return response()->json(['errors' => ['credentials' => 'Invalid credentials']], 401);
        } else {
            return $this->respondWithToken($token);
        }
    }

    public function invalidate()
    {
        $this->guard()->logout();

        return response()->json(['message' => 'Successfully logged out'], 200);
    }

    public function refresh()
    {
        return $this->respondWithToken($this->guard()->refresh());
    }

    public function user()
    {
        return response()->json($this->guard()->user(), 200);
    }
    
    public function confirm()
    {
        $confirmation_token = request()->confirmation_token;

        if (!$confirmation_token) {
            return response()->json(['error' => 'Bad request'], 400);
        } 

        $user = User::withoutGlobalScopes()
            ->where([['email_confirmed', 0], ['confirmation_token', $confirmation_token]])
            ->first();

        if (!$user) {
            return response()->json(['error' => 'Invalid confirmation code'], 401);
        }

        $user->email_confirmed = 1;
        $user->confirmation_token = null;
        $user->save();

        event(new UserConfirmed($user));

        $token = JWTAuth::fromUser($user);

        return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'token' => $token,
            'expires' => Carbon::now()->addMinutes(JWTFactory::getTTL())->toDateTimeString()
        ]);
    }

    protected function guard()
    {
        return Auth::guard();
    }
}
