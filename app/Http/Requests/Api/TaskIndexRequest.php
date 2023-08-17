<?php

namespace App\Http\Requests\Api;

use App\Enums\TaskStatusEnum as Status;

class TaskIndexRequest extends TaskOrderRequest
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
            'status' => ['string', sprintf('in:%s,%s', Status::DONE->value, Status::TODO->value)],
            'priority' => ['integer', 'min:1', 'max:5'],
            'title' => ['string', 'max:255', 'min:4'],
        ];
        return array_merge(parent::rules(), $subRules);
    }
}
