<?php

declare(strict_types=1);

namespace App\Http\Requests\Task;

use App\Enums\TaskStatusEnum as Status;
use App\Http\Requests\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class CreateRequest extends FormRequest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'parent_id' => ['integer', 'nullable'],
            'status' => ['required', 'string', sprintf('in:%s,%s', Status::DONE->value, Status::TODO->value)],
            'priority' => ['required', 'integer', 'min:1', 'max:5'],
            'title' => ['required', 'string', 'max:255', 'min:3'],
            'description' => ['required', 'string', 'max:2048', 'min:8'],
        ];
    }
}
