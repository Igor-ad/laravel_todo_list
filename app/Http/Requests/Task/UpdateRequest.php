<?php

declare(strict_types=1);

namespace App\Http\Requests\Task;

use App\Enums\TaskStatusEnum as Status;
use App\Http\Requests\RequestInterface;

class UpdateRequest extends CreateRequest implements RequestInterface
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
            'status' => ['string', sprintf('in:%s,%s', Status::DONE->value, Status::TODO->value)],
            'priority' => ['integer', 'min:1', 'max:5'],
            'title' => ['string', 'min:3', 'max:255'],
            'description' => ['string', 'min:8', 'max:2048'],
        ];

        return array_merge(parent::rules(), $subRules);
    }
}
