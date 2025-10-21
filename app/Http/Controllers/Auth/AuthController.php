<?php

namespace App\Http\Controllers\Auth;

use App\Http\Requests\Auth\LoginRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Log;

class AuthController
{
    public function authenticate(LoginRequest $request): JsonResponse
    {
        try {
            $request->authenticate();
            session()->regenerate();
            Log::info(auth()->user());
            return response()->json('Authenticated');
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['error' => 'Unauthorized'], 403);
        }

    }

    public function logout(Request $request): JsonResponse
    {
        Auth::logout();
        session()->invalidate();
        session()->regenerateToken();
        return response()->json('Logout');
    }
}
