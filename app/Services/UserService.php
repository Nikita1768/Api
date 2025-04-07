<?php

namespace App\Services;

use App\DTO\UserData;
use App\Http\Resources\PostCollection;
use App\Http\Resources\UserPlanCollection;
use App\Repository\PlanRepository;
use App\Repository\PostRepository;
use App\Repository\UserRepository;
use Illuminate\Http\JsonResponse;

class UserService
{

    public function __construct(
        protected PlanRepository $planRepository,
        protected UserRepository $userRepository,
        protected PostRepository $postRepository,
    )
    {
    }

    public function register(UserData $userData): JsonResponse
    {
        $user = $this->userRepository->createUser($userData);
        $token = $user->createToken('user_token')->plainTextToken;
        return response()->json([
            'user_token' => $token,
        ]);
    }

    public function getAll(): JsonResponse
    {
        $posts = $this->postRepository->getByAuthUser();
        return response()->json(PostCollection::make($posts));
    }

    public function getAllPlans(): JsonResponse
    {
        $plans = $this->planRepository->getByAuthUser();
        return response()->json(UserPlanCollection::make($plans));
    }
}
