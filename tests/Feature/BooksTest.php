<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BooksTest extends TestCase
{
    public function test_external_api_call()
    {
        $response = $this->getJson('/external-books/name', ['name' => 'A Game of Thrones']);
        $response->assertStatus($status = 200);
    }

    public function test_create_books()
    {
        
    }
}
