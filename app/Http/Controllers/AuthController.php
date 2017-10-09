<?php

namespace App\Http\Controllers;

use Auth;
use JWTAuth;
use JWTFactory;
use App\User;
use App\Mail\Welcome;
use App\Events\UserRegistration;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Carbon\Carbon;
use App\Http\Requests\RegistrationRequest;
use App\Http\Requests\AuthenticationRequest;

class AuthController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth:api')->except('register', 'authenticate');
    }

    public function register(RegistrationRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt($request->password)
        ]);

        $token = JWTAuth::fromUser($user);

        event(new UserRegistration($user));

        return $this->respondWithToken($token);
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
