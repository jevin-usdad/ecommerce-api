<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class SellerAuthController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'email'    => 'required|email',
            'password' => 'required'
        ]);

        if (!Auth::attempt($request->only('email', 'password'))) {
            return response()->json([
                'message' => 'Invalid credentials'
            ], 401);
        }

        $user = Auth::user();

        if ($user->role->name !== 'seller') {
            Auth::logout();
            return response()->json([
                'message' => 'Unauthorized'
            ], 403);
        }

        $token = $user->createToken('seller-token')->plainTextToken;

        return response()->json([
            'token' => $token,
            'role'  => 'seller',
            'user'  => [
                'id'    => $user->id,
                'name'  => $user->name,
                'email' => $user->email
            ]
        ]);
    }
}
