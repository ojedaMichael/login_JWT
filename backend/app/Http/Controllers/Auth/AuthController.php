<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {

        $user = User::Create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => bcrypt( $request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'),201);
    }

    public function login(LoginRequest $request) {

        $credeciales = $request->only('email', 'password');

        if (!$token = JWTAuth::attempt($credeciales)) {

            return response()->json(['error'=> 'invalid_crendecials', 401]);
        
        }

        $user = User::where('email', $request->email)->first();

        return response()->json(compact('user', 'token'),201);
    }
}
