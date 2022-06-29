<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\JsonResponse;

class CategoryController extends Controller
{
    public function store(CategoryRequest $request): JsonResponse
    {
        $params = $request->validated();

        $category = Category::create($params);

        return response()->json([
            'status' => 'created',
            'category' => new CategoryResource($category)
        ]);
    }

    public function destroy(int $id): JsonResponse
    {
        $category = Category::find($id);

        if ($category) {
            if ($category->products()->exists()) {
                $response = ['message' => 'Невозможно удалить категорию, относящуюся хотя бы к одному товару.'];
            } else {
                $category->delete();
                $response = ['status' => 'deleted', 'category' => new CategoryResource($category)];
            }
        } else {
            $response = ['message' => 'Категория не найдена'];
        }

        return response()->json($response);
    }
}
