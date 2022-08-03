<?php

namespace Tests\Feature\API;

use App\Models\Comment;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    //use RefreshDatabase;

    /**
     */
    public function test_new_comment_by_guest()
    {
        $response = $this->postJson('/api/comment', ['post_id' => 1, 'content' => 'testByGuest', 'pseudo' => 'TestingDude', 'email' => 'test@test.fr']);
        $response->assertStatus(201);
        $this->assertDatabaseHas('comments', ['post_id' => 1, 'content' => 'testByGuest', 'pseudo' => 'TestingDude', 'email' => 'test@test.fr']);
        $response->assertJson(['post_id' => 1, 'content' => 'testByGuest', 'pseudo' => 'TestingDude', 'email' => 'test@test.fr']);
    }

    // Marche pas!
    public function test_new_comment_by_auth()
    {
        $response = $this->postJson('/api/comment', ['post_id' => 1, 'content' => 'testByAuth', 'user_id' => 2]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('comments', ['post_id' => 1, 'content' => 'testByAuth', 'user_id' => 2]);
        $response->assertJson(['post_id' => 1, 'content' => 'testByAuth', 'user_id' => 2]);

    }

    public function test_fail_if_guest_missing_email()
    {
        $response = $this->postJson('/api/comment', ['post_id' => 1, 'content' => 'testByGuest', 'pseudo' => 'TestingDude']);
        $response->assertStatus(422);
    }

    public function test_fail_if_auth_missing_id()
    {
        $response = $this->postJson('/api/comment', ['post_id' => 1, 'content' => 'testByAuth']);
        $response->assertStatus(422);
    }
}
