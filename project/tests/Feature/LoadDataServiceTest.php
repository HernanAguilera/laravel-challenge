<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Models\Category;
use App\Services\LoadDataService;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Http;

class LoadDataServiceTest extends TestCase
{
    use RefreshDatabase;

    public function test_load_data_service_fetches_and_stores_entities()
    {
        Category::create(['category' => 'Animals']);

        Http::fake([
            '*' => Http::response([
                'count' => 1,
                'entries' =>
                [
                    [
                        'API' => 'Test API',
                        'Description' => 'Test Description',
                        'Link' => 'http://test.com',
                        'Category' => 'Animals'
                    ]
                ]
            ], 200)
        ]);

        $service = new LoadDataService();
        $service->fetchAndStoreEntities('Animals');

        $this->assertDatabaseHas('entities', ['api' => 'Test API']);
    }
}
