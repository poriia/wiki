<?php

namespace Tests\Unit;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class WikiValidationTest extends TestCase
{
    use RefreshDatabase;

    public function test_it_must_have_a_title_in_wiki_store()
    {
        $response = $this->postJson('/api/v1/wiki', [
            'content' => 'This is a wiki content',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('title');
    }

    public function test_it_must_have_a_content_in_wiki_store()
    {
        $response = $this->postJson('/api/v1/wiki', [
            'title' => 'This is a wiki title',
        ]);

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('content');
    }

    public function test_it_must_have_search_in_wiki_search()
    {
        $response = $this->getJson('/api/v1/wiki');

        $response->assertStatus(422);
        $response->assertJsonValidationErrors('search');
    }
}
