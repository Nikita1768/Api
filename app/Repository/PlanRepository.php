<?php

namespace App\Repository;

use App\DTO\PlanData;
use App\Enums\PostStatusEnum;
use App\Models\Plan;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\DB;

class PlanRepository
{
    const PER_PAGE = 8;

    public function create(PlanData $planData): Plan
    {
        return Plan::create($planData->toArray());
    }

    public function getAllPlans(): LengthAwarePaginator
    {
        return Plan::query()
            ->paginate(self::PER_PAGE);
    }

    public function getAvailable()
    {
        return Plan::query()
            ->available()
            ->paginate(self::PER_PAGE);
    }

    public function buy(int $id): void
    {
        $publications = Plan::query()
            ->where('id', $id)
            ->value('publications');
        DB::table('plan_user')->insert([
            'user_id' => auth()->id(),
            'plan_id' => $id,
            'publications' => $publications,
            'created_at' => now(),
        ]);
    }

    public function getByAuthUser(): LengthAwarePaginator
    {
        return auth()->user()->plans()->paginate(self::PER_PAGE);
    }

}
