<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TaskRequest extends FormRequest
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
            'user_id' => ['required', 'integer'],
            'status' => ['required', 'string', 'max:4', 'min:4', 'alpha_dash'],
            'priority' => ['required', 'integer', 'digits_between: 1,5'],
            'title' => ['required', 'string', 'max:255', 'min:4'],
            'description' => ['required', 'string', 'max:2048', 'min:8'],
        ];
    }
}
