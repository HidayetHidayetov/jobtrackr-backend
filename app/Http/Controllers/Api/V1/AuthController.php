<?php

namespace App\Http\Controllers\Api\V1;

use App\Services\AuthService;
use App\Http\Requests\RegisterRequest;
use Illuminate\Http\JsonResponse;
use App\Http\Controllers\Controller;

class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function register(RegisterRequest $request): JsonResponse
    {
        $user = $this->authService->register($request->validated());
        $token = $user->createToken('api_token')->plainTextToken;

        return response()->json([
            'user' => $user,
            'token' => $token,
        ], 201);
    }
}
