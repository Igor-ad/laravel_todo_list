<?php

namespace App\Http\Requests\Api;

use App\Enums\SortEnum;
use App\Enums\SortOrderEnum;

class TaskOrderRequest extends ApiFormRequest
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
     * @keys 'prioritySort', 'createdSort, 'completedSort' (SortEnum)
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            SortEnum::priority->value => ['string', sprintf('in:%s,%s', SortOrderEnum::ASC->value, SortOrderEnum::DESC->value)],
            SortEnum::created_at->value => ['string', sprintf('in:%s,%s', SortOrderEnum::ASC->value, SortOrderEnum::DESC->value)],
            SortEnum::completed_at->value => ['string', sprintf('in:%s,%s', SortOrderEnum::ASC->value, SortOrderEnum::DESC->value)],
        ];
    }
}
