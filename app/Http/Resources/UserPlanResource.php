<?php

namespace App\Http\Resources;

use App\Enums\PostStatusEnum;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserPlanResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        $publications=[];
        if ($this->pivot->created_at > now()->subDays(30)) {
            $status = PostStatusEnum::ACTIVE->name();
            $publications = ['publications' => $this->pivot->publications];
        } else {
            $status = PostStatusEnum::INACTIVE->name();
        };
        return [
            'id' => $this->id,
            'title' => $this->title,
            'description' => $this->description,
            'user_id' => $this->user_id,
            'status' => $status,
            'buying_date' => $this->pivot->created_at->format('d.m.Y'),
        ] + $publications;
    }
}
