<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use App\Models\Entity;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_api_returns_entities_for_valid_category()
    {
        $category = Category::create(['category' => 'Animals']);

        Entity::create([
            'api' => 'Test API',
            'description' => 'Test Description',
            'link' => 'http://test.com',
            'category_id' => $category->id
        ]);

        $response = $this->get('/api/animals');

        $response->assertStatus(200)
            ->assertJsonStructure([
                'success',
                'data' => [
                    ['api', 'description', 'link', 'category' => ['id', 'category']]
                ]
            ]);
    }

    public function test_api_returns_404_for_invalid_category()
    {
        $response = $this->get('/api/nonexistent');

        $response->assertStatus(404)
            ->assertJson(['success' => false, 'message' => 'Category not found']);
    }
}
