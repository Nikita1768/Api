<?php

namespace App\Services;

use App\DTO\LoginData;
use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Auth;
use function Laravel\Prompts\error;

class LoginService
{
    public function __construct(
        protected UserRepository $repository,
    )
    {
    }

    public function login(LoginData $loginData): JsonResponse
    {
        if (Auth::attempt($loginData->toArray())) {
            $user = $this->repository->getByEmail($loginData->email);
            $user->tokens()->delete();
            $token = $user->createToken('login_token')->plainTextToken;
            return response()->json([
                'login_token' => $token,
            ]);
        }
        return response()->json([
            'message' => ['Credentials not found'],
        ]);
    }
}
