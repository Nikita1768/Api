<?php

namespace App\Services;

use App\DTO\PlanData;
use App\Http\Resources\PlanCollection;
use App\Http\Resources\PlanResource;
use App\Repository\PlanRepository;
use Illuminate\Http\JsonResponse;
use function Illuminate\Events\queueable;

class PlanService
{
    public function __construct(
        public PlanRepository $repository
    )
    {
    }

    public function create(PlanData $planData): JsonResponse
    {
        $plan = $this->repository->create($planData);
        return response()->json(PlanResource::make($plan), 201);
    }

    public function getAllPlans(): JsonResponse
    {
        $plans = $this->repository->getAllPlans();
        return response()->json(PlanCollection::make($plans), 201);
    }

    public function getAvailable(): JsonResponse
    {
        $plans = $this->repository->getAvailable();
        return response()->json(PlanCollection::make($plans));
    }

    public function buy(int $id): JsonResponse
    {
        if (auth()->user()->hasActivePlan()) {
            return response()->json(['Message' => 'You have active plan.']);
        }
        $this->repository->buy($id);
        return response()->json(['Message' => 'You have successfully buy plan']);
    }

}
