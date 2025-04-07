<?php

namespace App\Http\Controllers\Api;

use App\DTO\UserData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Register\StoreRequest;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;

class RegisterController extends Controller
{

    public function __construct(
        protected UserService $service
    )
    {
    }

    public function store(StoreRequest $request): JsonResponse
    {
        $userData = new UserData(...$request->validated());
        return $this->service->register($userData);
    }
}
