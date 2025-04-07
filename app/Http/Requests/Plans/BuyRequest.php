<?php

namespace App\Http\Requests\Plans;

use App\Enums\PlanStatusEnum;
use App\Models\Plan;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class BuyRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'plan' => [
                'required',
                'integer',
                Rule::exists('plans', 'id')
                    ->where('status', PlanStatusEnum::ACTIVE->value)],
        ];
    }

    public function validationData(): ?array
    {
        return $this->all() + $this->route()->parameters();
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->plan,
        ]);
    }
}
