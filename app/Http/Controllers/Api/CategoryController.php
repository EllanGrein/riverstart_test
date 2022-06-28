<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\CategoryRequest;
use App\Http\Resources\Category\CategoryResource;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function store(CategoryRequest $request)
    {
        $params = $request->validated();

        $category = Category::create($params);

        return response()->json([
            'status' => 'created',
            'category' => new CategoryResource($category)
        ]);
    }

    public function destroy(Category $category)
    {
        $category->delete();

        return response()->json([
            'status' => 'deleted',
            'category' => new CategoryResource($category)
        ]);
    }
}
