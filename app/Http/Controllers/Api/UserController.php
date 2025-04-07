<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Services\UserService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class UserController extends \Illuminate\Routing\Controller
{

    public function __construct(
        protected UserService $service
    )
    {
    }

    public function posts(): JsonResponse
    {
        return $this->service->getAll();
    }

    public function plans(): JsonResponse
    {
        return $this->service->getAllPlans();
    }
}
