<?php

namespace App\Services;

use App\Models\Entity;
use App\Models\Category;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class LoadDataService
{
    protected string $url;

    public function __construct()
    {
        $this->url = config('app.api_url');
    }

    public function fetchAndStoreEntities(string $categoryName): void
    {
        $category = Category::where('category', $categoryName)->first();

        if (!$category) {
            throw new \Exception('Category not found: ' . $categoryName);
        }

        $response = Http::get($this->url);
        if ($response->failed()) {
            throw new \Exception('Failed to fetch entries.json');
        }

        $entities = $response->json();

        if (!is_array($entities) || !array_key_exists('entries', $entities)) {
            throw new \Exception('Invalid entries.json');
        }

        $entities = $entities['entries'];

        if (count($entities) === 0) {
            throw new \Exception('No entries found');
        }

        foreach ($entities as $key => $entity) {
            if ($entity['Category'] !== $categoryName) {
                continue; // Solo procesar la categoría indicada
            }

            Entity::updateOrCreate([
                'api' => $entity['API'],
            ], [
                'description' => $entity['Description'],
                'link' => $entity['Link'],
                'category_id' => $category->id,
            ]);
        }
    }
}
