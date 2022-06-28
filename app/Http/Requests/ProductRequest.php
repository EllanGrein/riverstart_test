<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ProductRequest extends FormRequest
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'price' => 'required|numeric|gt:0',
            'is_published' => 'nullable|boolean',
            'is_deleted' => 'nullable|boolean'
        ];
    }

    public function messages(){
        return [
            'name.required' => 'Название товара обязательно',
            'name.max' => 'Максимальное значение для названия товара - 255 символов',
            'price.required' => 'Пожалуйста, укажите цену',
            'price.gt' => 'Цена товара должна быть больше нуля'
        ];
    }
}
