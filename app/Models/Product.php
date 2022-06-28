<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель товара
 *
 * @property string $name
 * @property float $price
 * @property bool $is_published
 * @property bool $is_deleted
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'is_published', 'is_deleted'];

    public function categories() {
        return $this->belongsToMany(Category::class, 'categories_products')->using(CategoryProduct::class);
    }
}
