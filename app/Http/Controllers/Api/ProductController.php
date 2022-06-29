<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\Product\ProductCollection;
use App\Http\Resources\Product\ProductResource;
use App\Models\Product;
use Illuminate\Http\JsonResponse;

class ProductController extends Controller
{
    public function index(): JsonResponse
    {
        $products = Product::all();

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
