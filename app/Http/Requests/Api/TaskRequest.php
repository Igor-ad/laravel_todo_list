<?php

namespace App\Http\Requests\Api;

class TaskRequest extends ApiFormRequest
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
        return [
            'parent_id' => ['integer'],
            'user_id' => ['integer'],
            'status' => ['required', 'string', 'in:todo,done'],
            'priority' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['required', 'string', 'max:255', 'min:4'],
            'description' => ['required', 'string', 'max:2048', 'min:8'],
        ];
    }
}
