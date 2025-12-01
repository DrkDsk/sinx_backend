<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthController extends Controller
{

    public function getUser(Request $request) {
        return $request->user();
    }

    public function login(LoginRequest $request)
    {
        $email = $request->input('email');
        $password = $request->input('password');

        $user = User::query()->where('email', $email)->first();
        $isValid = $user && Hash::check($password, $user->password);

        if (!$isValid) {
            return response()->json([
                'message' => 'Wrong password',
            ]);
        }

        $token = $user->createToken("")->plainTextToken;

        return response()->json([
            'data' => [
                'token' => $token,
            ]
        ]);
    }
}
