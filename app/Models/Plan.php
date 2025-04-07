<?php

namespace App\Models;

use App\Enums\PlanStatusEnum;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Plan extends Model
{
    /** @use HasFactory<\Database\Factories\PlansFactory> */
    use HasFactory;

    protected $fillable = ['name', 'price', 'publications', 'status'];

    protected $casts = [
        'status' => PlanStatusEnum::class
    ];

    public function users(): belongsToMany
    {
        return $this->belongsToMany(User::class)
            ->withPivot(['publications', 'created_at']);
    }
    public function scopeAvailable(Builder $query): void
    {
        $query->where('status','=', PlanStatusEnum::ACTIVE->value);
    }
}
