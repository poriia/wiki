<?php

namespace Tests\Feature;

use App\Models\Wiki;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WikiApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_store_new_wiki_with_api_call()
    {
        $wiki = Wiki::factory()->raw();
        $response = $this->postJson('/api/v1/wiki', $wiki);

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'code' => 200,
            'message' => 'Wiki was created',
            'data' => [],
        ]);
    }

    public function test_it_can_search_wiki_by_title_or_content()
    {

        $wiki = Wiki::factory()->create([
            'title' => 'Test Title',
            'content' => 'Test Content',
        ]);

        $response = $this->getJson('/api/v1/wiki?search=Test');

        $response->assertStatus(200);
        $response->assertJson([
            'success' => true,
            'code' => 200,
            'message' => 'Wiki was found',
            'data' => [
                [
                    'id' => $wiki->id,
                    'title' => 'Test Title',
                    'content' => 'Test Content',
                ],
            ],
        ]);
    }
}
