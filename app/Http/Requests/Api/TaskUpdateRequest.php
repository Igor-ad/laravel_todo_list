<?php

namespace App\Http\Requests\Api;

class TaskUpdateRequest extends TaskRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        $subRules = [
            'id' => ['required', 'integer'],
            'status' => ['string', 'in:todo,done'],
            'priority' => ['integer', 'min:1', 'max:5'],
            'title' => ['string', 'max:255', 'min:4'],
            'description' => ['string', 'max:2048', 'min:8'],
        ];

        return array_merge(parent::rules(), $subRules);
    }
}
