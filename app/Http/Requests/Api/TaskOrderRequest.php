<?php

namespace App\Http\Requests\Api;

use App\Enums\OrderEnum as Order;
use App\Enums\OrderDirectionEnum as Direct;

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
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            Order::priority->value => ['string', sprintf('in:%s,%s', Direct::ASC->value, Direct::DESC->value)],
            Order::created_at->value => ['string', sprintf('in:%s,%s', Direct::ASC->value, Direct::DESC->value)],
            Order::completed_at->value => ['string', sprintf('in:%s,%s', Direct::ASC->value, Direct::DESC->value)],
        ];
    }
}
