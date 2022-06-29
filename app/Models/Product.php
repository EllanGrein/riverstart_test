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
 * @method
 */
class Product extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'price', 'is_published', 'is_deleted'];

    /**
     * Связь с категориями
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function categories() {
        return $this->belongsToMany(Category::class, 'categories_products')->using(CategoryProduct::class);
    }

    /**
     * Связывание модели товара с категориями
     *
     * @param array $categories
     * @return void
     */
    public function setCategories(array $categories)
    {
        foreach ($categories as $category) {
            $categoryIds[] = $category['id'];
        }

        $this->categories()->sync($categoryIds);
    }
}
