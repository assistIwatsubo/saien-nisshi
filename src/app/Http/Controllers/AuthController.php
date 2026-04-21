<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\MeResource;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        $start = microtime(true);

        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required', 'string', 'min:8'],
        ]);
        $beforeAttempt = microtime(true);

        if (!$token = JWTAuth::attempt($credentials)) {
            $afterAttempt = microtime(true);
            \Log::info('JWTAuth::attempt timing: ' . ($afterAttempt - $beforeAttempt) . 's');
            return response()->json(['error' => 'Unauthorized', 'message' => 'メールアドレスまたはパスワードが正しくありません。'], 401);
        }

        $afterAttempt = microtime(true);

        \Log::info('JWTAuth::attempt timing: ' . ($afterAttempt - $beforeAttempt) . 's');

        $response = [
            'id' => JWTAuth::user()->id,
            'accessToken' => $token,
            'tokenType' => 'bearer',
            'expiresIn' => JWTAuth::factory()->getTTL() * 60
        ];

        $end = microtime(true);
        \Log::info('Total login timing: ' . ($end - $start) . 's');

        return response()->json($response);
    }


    public function me()
    {
        $user = JWTAuth::user();
        $user->load(
            'profile.favoriteCrop',
            'profile.helperCharacter',
            'profile.prefecture',
            'followings.profile',
        );

        return new MeResource($user);
    }

    public function logout()
    {
        try {
            JWTAuth::parseToken()->invalidate(); // 現在のトークンを無効化
            return response()->json(['message' => 'Successfully logged out']);
        } catch (\Tymon\JWTAuth\Exceptions\TokenInvalidException $e) {
            return response()->json(['error' => 'Token is invalid'], 401);
        }
    }

    public function refresh()
    {
        return response()->json([
            'access_token' => JWTAuth::refresh(JWTAuth::getToken())
        ]);
    }
}
