<?php

declare(strict_types=1);

namespace App\Http\Requests\Task;

use App\Enums\SortEnum;
use App\Enums\SortOrderEnum;
use App\Http\Requests\RequestInterface;
use Illuminate\Foundation\Http\FormRequest;

class OrderRequest extends FormRequest implements RequestInterface
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            SortEnum::priority->value => [
                'string', sprintf('in:%s,%s', SortOrderEnum::ASC->value, SortOrderEnum::DESC->value)
            ],
            SortEnum::created_at->value => [
                'string', sprintf('in:%s,%s', SortOrderEnum::ASC->value, SortOrderEnum::DESC->value)
            ],
            SortEnum::completed_at->value => [
                'string', sprintf('in:%s,%s', SortOrderEnum::ASC->value, SortOrderEnum::DESC->value)
            ],
        ];
    }
}
