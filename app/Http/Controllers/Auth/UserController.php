<?php

namespace App\Http\Controllers\Auth;

use App\Http\Resources\User\CurrentUserResource;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;

class UserController
{
    public function user(Request $request): JsonResponse
    {
        $user = $request->user();
        return response()->json(['user'=>new CurrentUserResource($user), 'permissions'=>$user->jsPermissions()]);
    }
}
