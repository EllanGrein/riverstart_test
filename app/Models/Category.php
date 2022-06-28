<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * Модель категории
 *
 * @property string $name
 */
class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function products() {
        return $this->belongsToMany(Product::class, 'categories_products')->using(CategoryProduct::class);
    }
}
