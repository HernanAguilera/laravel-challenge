<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Entity;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EntityTest extends TestCase
{
    use RefreshDatabase;

    public function test_entity_can_be_created()
    {
        $category = Category::create(['category' => 'TestCategory']);

        Entity::create([
            'api' => 'Test API',
            'description' => 'Test Description',
            'link' => 'http://test.com',
            'category_id' => $category->id
        ]);

        $this->assertDatabaseHas('entities', ['api' => 'Test API']);
    }

    public function test_cannot_create_entity_without_category()
    {
        $this->expectException(\Illuminate\Database\QueryException::class);

        Entity::create([
            'api' => 'Test API',
            'description' => 'Test Description',
            'link' => 'http://test.com',
            'category_id' => null
        ]);
    }
}
