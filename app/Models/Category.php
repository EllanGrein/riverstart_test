<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

/**
 * Модель категории
 *
 * @property string $name
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    /**
     * Связь с товарами
     *
     * @return BelongsToMany
     */
    public function products(): BelongsToMany
    {
        return $this->belongsToMany(Product::class, 'categories_products')->using(CategoryProduct::class);
    }
}
