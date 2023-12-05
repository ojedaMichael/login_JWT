<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\Auth\RegisterRequest;
use App\Models\User;
use App\Models\usuario;
use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use JWTAuth;

class AuthController extends Controller
{
    public function register(RegisterRequest $request) {

        $user = User::Create([
            'name' => $request->name,
            'usuarioCreacion' => $request->usuario,
            'email' => $request->email,
            'fecha' => date('y-m-d'),
            'fechaCreacion' => date('y-m-d'),
            'password' => bcrypt( $request->password),
        ]);

        $token = JWTAuth::fromUser($user);

        return response()->json(compact('user', 'token'),201);
    }

    public function login(LoginRequest $request) {

        $credeciales = $request->only('password','email');

        if (!$token = JWTAuth::attempt($credeciales)) {
            return response()->json(['error' => 'invalid_credentials'], 401);
        }

        $user = User::where('email', $request->email)->first();

        return response()->json(compact('user', 'token'), 201);
    }
}
