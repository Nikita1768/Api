<?php

namespace App\Http\Controllers\Api;

use App\DTO\PlanData;
use App\Http\Controllers\Controller;
use App\Http\Requests\Plans\BuyRequest;
use App\Http\Requests\Plans\StorePlansRequest;
use App\Http\Requests\Plans\UpdatePlansRequest;
use App\Models\Plan;
use App\Services\PlanService;
use Illuminate\Http\JsonResponse;

class PlanController extends Controller
{
    public function __construct(
        protected PlanService $service
    )
    {
    }

    public function available(): JsonResponse
    {
        return $this->service->getAvailable();
    }

    public function buy(BuyRequest $request): JsonResponse
    {
        return $this->service->buy($request->id);
    }

    /**
     * Display a listing of the resource.
     */
    public function index(): JsonResponse
    {
        return $this->service->getAllPlans();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePlansRequest $request): JsonResponse
    {
        $planData = new PlanData(...$request->validated());
        return $this->service->create($planData);
    }

    /**
     * Display the specified resource.
     */
    public function show(Plan $plans)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePlansRequest $request, Plan $plans)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Plan $plans)
    {
        //
    }
}
