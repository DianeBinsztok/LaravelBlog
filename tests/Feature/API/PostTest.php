<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertJson;

class PostTest extends TestCase
{
    //use RefreshDatabase;

    public function test_get_homepage()
    {
        $response = $this->get('/api/');
        $response->assertStatus(200);
    }

    public function test_get_all_posts()
    {
        $response = $this->get('/api/');
        $response->assertStatus(200)
            ->assertJson([
            ]);
    }

    public function test_cant_get_post_if_invalid_id()
    {
        $response = $this->get('/api/posts/2000');
        $response->assertStatus(404);
    }
    //get:
//assertDatabaseHas
//assertOK
    //post:
//assertCreated
}
