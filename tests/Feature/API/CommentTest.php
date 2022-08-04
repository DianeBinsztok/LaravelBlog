<?php

namespace Tests\Feature\API;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CommentTest extends TestCase
{
    use RefreshDatabase;

    //Marche pas !
    public function test_new_comment_by_guest()
    {
        $response = $this->postJson('/api/comment', ['post_id' => 1, 'content' => 'testByGuest', 'pseudo' => 'TestingDude', 'email' => 'test@test.fr']);
        $response->assertStatus(201);
        $this->assertDatabaseHas('comments', ['post_id' => 1, 'content' => 'testByGuest', 'pseudo' => 'TestingDude', 'email' => 'test@test.fr']);
        $response->assertJson(['post_id' => 1, 'content' => 'testByGuest', 'pseudo' => 'TestingDude', 'email' => 'test@test.fr']);
    }

    public function test_new_comment_by_guest_with_factory()
    {
        $user = User::factory()->create();
        $post = Post::factory()
            ->for($user)
            ->create();
        $comment = Comment::factory()
            ->for($post)
            ->state(["pseudo" => "Testing Dude", "email" => "test@test.fr"])
            ->create();
        $response = $this->postJson('/api/comment', ['post_id' => $comment->post_id, 'content' => $comment->content, 'pseudo' => $comment->pseudo, 'email' => $comment->email]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('comments', ['post_id' => $comment->post_id, 'content' => $comment->content, 'pseudo' => $comment->pseudo, 'email' => $comment->email]);
        $response->assertJson(['post_id' => $comment->post_id, 'content' => $comment->content, 'pseudo' => $comment->pseudo, 'email' => $comment->email]);
    }

    //Marche pas!
    public function test_new_comment_by_auth()
    {
        $user = User::factory()->create();
        $post = Post::factory()
            ->for($user)
            ->create();

        $comment = Comment::factory()
            ->for($post)
            ->for(User::factory()->create())
            ->create();

        $response = $this->postJson('/api/comment', ['post_id' => $comment->post_id, 'content' => $comment->content, 'user_id' => $comment->user_id]);
        $response->assertStatus(201);
        $this->assertDatabaseHas('comments', ['post_id' => $comment->post_id, 'content' => $comment->content, 'user_id' => $comment->user_id]);
        $response->assertJson(['post_id' => $comment->post_id, 'content' => $comment->content, 'user_id' => $comment->user_id]);
    }

    public function test_fail_if_guest_missing_email()
    {
        $user = User::factory()->create();
        $post = Post::factory()
            ->for($user)
            ->create();
        $comment = Comment::factory()
            ->for($post)
            ->create();
        $response = $this->postJson('/api/comment', ['post_id' => $comment->post_id, 'content' => $comment->content, 'pseudo' => $comment->pseudo]);
        $response->assertStatus(422);
    }

    public function test_fail_if_auth_missing_id()
    {
        $response = $this->postJson('/api/comment', ['post_id' => 1, 'content' => 'testByAuth']);
        $response->assertStatus(422);
    }
}
