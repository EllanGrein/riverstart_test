<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Arr;

class ProductListRequest extends FormRequest
{
    public function rules(): array
    {
        return [
            'filter.name' => 'nullable|string',
            'filter.price_min' => 'nullable|int|min:0',
            'filter.price_max' => 'nullable|int|min:0',
            'filter.category_id' => 'nullable|int',
            'filter.is_published' => 'nullable|boolean',
            'filter.is_deleted' => 'nullable|boolean',
        ];
    }

    /** @return mixed */
    public function filter(string $key)
    {
        return Arr::get($this->filter, $key);
    }
}
