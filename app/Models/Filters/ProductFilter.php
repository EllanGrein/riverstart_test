<?php

namespace App\Models\Filters;

use App\Http\Requests\ProductListRequest;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Facades\DB;

trait ProductFilter
{
    public function scopeFilter(Builder $query, ProductListRequest $request): void
    {
        if ($name = $request->filter('name')) {
            $query->where('name', 'LIKE', "%$name%");
        }

        if ($request->filter('price_min') && $request->filter('price_max')) {
            $price_min = $request->filter('price_min');
            $price_max = $request->filter('price_max');
            $query->where('price', '>=', "$price_min")
                ->where('price','<=', "$price_max");
        }

        if ($category_id = $request->filter('category_id')) {
            $query->leftJoin('categories_products', 'products.id', '=', 'categories_products.product_id')
                ->where('categories_products.category_id', '=', $category_id)
                ->select('products.*')
                ->groupBy('products.id');
        }

        if (is_string($request->filter('is_published'))) {
            $is_published = $request->filter('is_published');
            $query->where('is_published', '=', $is_published);
        }

        if (is_string($request->filter('is_deleted'))) {
            $is_deleted = $request->filter('is_deleted');
            $query->where('is_deleted', '=', $is_deleted);
        }
    }
}
