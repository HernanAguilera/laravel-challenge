<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Http\JsonResponse;

class EntityController extends Controller
{
    public function getEntitiesByCategory(string $categoryName): JsonResponse
    {
        $category = Category::where('category', $categoryName)->first();

        if (!$category) {
            return response()->json(['success' => false, 'message' => 'Category not found'], 404);
        }

        $entities = Entity::where('category_id', $category->id)->get()->map(function ($entity) use ($category) {
            return [
                'api' => $entity->api,
                'description' => $entity->description,
                'link' => $entity->link,
                'category' => [
                    'id' => $category->id,
                    'category' => $category->category
                ]
            ];
        });

        return response()->json(['success' => true, 'data' => $entities]);
    }
}
