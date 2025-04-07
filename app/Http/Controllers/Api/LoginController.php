<?php

namespace App\Http\Controllers\Api;

use App\DTO\LoginData;
use App\Http\Requests\Login\StoreRequest;
use App\Services\LoginService;
use Illuminate\Http\JsonResponse;
use Illuminate\Routing\Controller;

class LoginController extends Controller
{
    public function __construct(
        protected LoginService $service
    )
    {
    }


    public function store(StoreRequest $request): JsonResponse
    {
        $loginData = new LoginData(...$request->validated());
        return $this->service->login($loginData);
    }
}
