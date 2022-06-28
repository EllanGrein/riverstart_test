<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\Pivot;

/**
 * Модель связи Many-to-Many моделей Category и Product
 *
 * @property-read integer $id
 * @property integer $category_id
 * @property integer $product_id
 */
class CategoryProduct extends Pivot
{
    protected $table = 'categories_products';

    protected $fillable = [
        'category_id',
        'product_id'
    ];

}
