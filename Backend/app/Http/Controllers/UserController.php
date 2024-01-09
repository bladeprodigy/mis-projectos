<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    public function register(Request $request)
{
    try {
        $request->validate([
            'username' => 'required|max:255',
            'email' => 'required|email|unique:users',
            'password' => 'required|confirmed|min:8',
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

    if (Auth::attempt($credentials)) {
        $token = $request->user()->createToken('authToken')->plainTextToken;
        return response()->json(['user' => Auth::user(), 'token' => $token], 200);
    } else {
        return response()->json(['error' => 'Invalid credentials'], 401);
    }
}
}