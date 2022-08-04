<?php

namespace Tests\Feature\API;

use Tests\TestCase;

class HomepageTest extends TestCase
{
    //use RefreshDatabase;
    public function test_get_homepage()
    {
        $response = $this->getJson('/api/posts/');
        $response->assertStatus(200);
    }

    public function test_get_all_posts()
    {
        $response = $this->get('/api/')
            ->assertJson([
              //
            ]);
    }

    // tester si bdd vide
    public function test_empty_page_if_no_data()
    {
        $response = $this->get('/api/');
        // Que renvoyer?
        //$response->assertStatus(200);
    }
}
