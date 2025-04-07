<?php

namespace App\Http\Requests\Post;

class UpdateRequest extends StoreRequest
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
        $parentRules = parent::rules();
        $parentRules['id'] = ['required', 'integer', 'exists:App\Models\Post,id'];
        return $parentRules;
    }

    public function validationData(): array
    {
        return $this->all() + $this->route()->parameters();
    }

    public function prepareForValidation(): void
    {
        $this->merge([
            'id' => $this->post,
            'user_id' => auth()->id()
        ]);
    }
}
