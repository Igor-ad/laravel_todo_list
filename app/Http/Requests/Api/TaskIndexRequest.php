<?php

namespace App\Http\Requests\Api;

class TaskIndexRequest extends ApiFormRequest
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
            'status' => ['string', 'in:todo,done'],
            'priority' => ['integer', 'min:1', 'max:5'],
            'title' => ['string', 'max:255', 'min:4'],
            'prioritySort' => ['string', 'in:asc,desc'],
            'createdSort' => ['string', 'in:asc,desc'],
            'completedSort' => ['string', 'in:asc,desc'],
        ];
    }
}
