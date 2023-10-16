<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WikiStoreApiTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_can_store_new_wiki_with_api_call()
    {
        $data = [
            'title' => 'Test Title',
            'content' => 'Test Content',
        ];

        $response = $this->postJson('/api/v1/wiki', $data);

        $response->assertStatus(200);
        $response->assertJson([
            "success" => true,
            "code" => 200,
            "message" => "Wiki was created",
            "data" => []
        ]);
    }
}
