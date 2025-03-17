<?php

namespace Tests\Unit;

use Tests\TestCase;
use App\Models\Category;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CategoryTest extends TestCase
{
    use RefreshDatabase;

    public function test_category_can_be_created()
    {
        Category::create(['category' => 'TestCategory']);

        $this->assertDatabaseHas('categories', ['category' => 'TestCategory']);
    }
}
