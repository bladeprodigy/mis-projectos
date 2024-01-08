<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Illuminate\Support\Facades\Auth;

class UserController extends Controller
{
    public function register(Request $request)
{
    $request->validate([
        'name' => 'required|max:255',
        'email' => 'required|email|unique:users',
        'password' => 'required|confirmed|min:8',
    ]);

    $user = new User;
    $user->name = $request->name;
    $user->email = $request->email;
    $user->password = Hash::make($request->password);
    $user->save();

    return response()->json($user, 201);
}

    public function login(Request $request)
{
    
    $request->validate([
        'email' => 'required|email',
        'password' => 'required|min:8',
    ]);

    $credentials = $request->only('email', 'password');

    if (Auth::attempt($credentials)) {
        $request->session()->regenerate();
        return response()->json(['message' => 'Login successful'], 200);
    }

    return response()->json(['message' => 'Invalid credentials'], 401);
}

    public function changePassword(Request $request)
    {
        $request->validate([
            'old_password' => 'required',
            'new_password' => 'required|min:8|confirmed',
        ]);

        return response()->json([
            'message' => 'Password changed successfully'
        ], 200);
    }

    public function deleteUser(Request $request)
    {
        $user = Auth::user();
    
        if (!$user) {
            return response()->json([
                'message' => 'No user is currently authenticated'
            ], 401);
        }
    
        $user->delete();
    
        return response()->json([
            'message' => 'User deleted successfully'
        ], 200);
    }
?>