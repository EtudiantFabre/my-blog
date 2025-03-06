<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Auth;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        //validate fields
        $attrs = $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);

        if (!Auth::attempt($attrs)) {
            return response(['message' => 'Invalid credentials.'], 403);
        }

        //  return user & token in response
        return response()->json([
            'user' => auth()->user(),
            'token' => auth()->user()->createToken('secret')->plainTextToken
        ]);
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
        return response([
            'message' => 'Déconnexion réussit!'
        ], 200);
    }

    public function user()
    {
        return response(['user' => auth()->user()], 200);
    }
}
