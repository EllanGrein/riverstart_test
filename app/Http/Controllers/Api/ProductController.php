<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductListRequest;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    /**
     * Получение списка товаров.
     *  - По совпадению с именем: api/products?filter[name]=productname
     *  - По id категории: api/products?filter[category_id]=1
     *  - По цене "от - до": api/products?filter[price_min]=5000&filter[price_max]=10000
     *  - Опубликованные / не опубликованные: api/products?filter[is_published]=1
     *  - Удаленные / не удалённые: api/products?filter[is_deleted]=0
     *
     * @param ProductListRequest $request
     * @return JsonResponse
     */
    public function index(ProductListRequest $request): JsonResponse
    {
        $products = Product::query()
            ->filter($request)
            ->get();

        return response()->json(
            new ProductCollection($products)
        );
    }

    public function store(ProductRequest $request): JsonResponse
    {
        $params = $request->validated();

        $product = Product::create([
            'name' => $params['name'],
            'price' => $params['price'],
        ]);

        $product->setCategories($params['categories']);

        return response()->json([
            'status' => 'created',
            'product' => new ProductResource($product)
        ]);
    }

    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $params = $request->validated();

        $product->update([
            'name' => $params['name'],
            'price' => $params['price'],
        ]);

        $product->updateCategories($params['categories']);

        return response()->json([
            'status' => 'updated',
            'product' => new ProductResource($product)
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $product = Product::find($id);

        if ($product) {
            $product->update(['is_deleted' => 1]);
            $response = ['status' => 'marked as deleted', 'product' => new ProductResource($product)];
        } else {
            $response = ['message' => 'Товар не найден'];
        }

        return response()->json($response);
    }
}
