<?php

namespace App\Http\Requests;

use App\Rules\ExistsByArrayOfIds;
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
            'is_deleted' => 'nullable|boolean',
            'categories' => ['required','array','between:2,10', new ExistsByArrayOfIds()],
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Название товара обязательно',
            'name.max' => 'Максимальное значение для названия товара - 255 символов',
            'price.required' => 'Пожалуйста, укажите цену',
            'price.gt' => 'Цена товара должна быть больше нуля',
            'categories.required' => 'Укажите категории товаров',
            'categories.between' => 'Количество категорий не должно быть меньше 2-х и превышать 10'
        ];
    }
}
