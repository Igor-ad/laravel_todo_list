<?php

declare(strict_types=1);

namespace App\Http\Requests\Task;

use App\Enums\TaskStatusEnum as Status;
use App\Http\Requests\RequestInterface;

class UpdateRequest extends CreateRequest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        $subRules = [
            'status' => ['string', sprintf('in:%s,%s', Status::DONE->value, Status::TODO->value)],
            'priority' => ['integer', 'min:1', 'max:5'],
            'title' => ['string', 'min:3', 'max:255'],
            'description' => ['string', 'min:8', 'max:2048'],
        ];

        return array_merge(parent::rules(), $subRules);
    }
}
