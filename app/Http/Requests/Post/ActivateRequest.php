<?php

namespace App\Http\Requests\Post;

use App\Enums\PostStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ActivateRequest extends FormRequest
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
            'post' => [
                'required',
                'integer',
                Rule::exists('posts', 'id')
                    ->where('status', PostStatusEnum::INACTIVE->value)
                    ->where('user_id', auth()->id())
            ]];
    }

    public function validationData(): array
    {
        return $this->all() + $this->route()->parameters();
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->post,
        ]);
    }

}
