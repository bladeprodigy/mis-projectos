<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Tymon\JWTAuth\Facades\JWTAuth;


class UserController extends Controller
{
    public function register(Request $request)
    {
        try {
            $request->validate([
                'username' => [
                    'required',
                    'max:255',
                    Rule::unique('users')->where(function ($query) use ($request) {
                        return $query->where('username', $request->username);
                    }),
                ],
                'email' => [
                    'required',
                    'email',
                    Rule::unique('users')->where(function ($query) use ($request) {
                        return $query->where('email', $request->email);
                    }),
                ],
                'password' => 'required|confirmed|min:8',
            ], [
                'username.required' => 'Username is required.',
                'username.max' => 'Username must not exceed 255 characters.',
                'username.unique' => 'Username already exists.',
                'email.required' => 'Email is required.',
                'email.email' => 'Use correct email format.',
                'email.unique' => 'User with this email already exists.',
                'password.required' => 'Password is required.',
                'password.confirmed' => 'Passwords do not match.',
                'password.min' => 'Password must be at least 8 characters.',
            ]);
    
            $user = new User;
            $user->username = $request->username;
            $user->email = $request->email;
            $user->password = Hash::make($request->password);
            $user->save();
    
            return response()->json($user, 201);
        } catch (ValidationException $e) {
            return response()->json(['error' => $e->errors()], 400);
        }
    }

    public function login(Request $request)
    {
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    $credentials = $request->only('email', 'password');

    if (!$token = JWTAuth::attempt($credentials)) {
        return response()->json(['error' => 'Invalid email or password'], 401);
    }

    return $this->respondWithToken($token);
    }

    protected function respondWithToken($token)
    {
        return response()->json([
            'access_token' => $token,
            'token_type' => 'bearer',
            'expires_in' => JWTAuth::factory()->getTTL() * 60
        ]);
    }
}