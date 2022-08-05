<?php

namespace Tests\Feature;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use function PHPUnit\Framework\assertJson;

class PostTest extends TestCase
{
    use RefreshDatabase;

    public function test_get_posts()
    {
        $response = $this->getJson('/api/posts');
        $response->assertStatus(200);
    }
    /*
        //Marche pas!
        public function test_get_all_posts()
        {
            $users = User::factory()->count(10)->create();
            $posts = Post::factory()
                ->count(5)
                ->forEachSequence($users)
                ->create();
            $comment = Comment::factory()
                ->forEachSequence($posts)
                ->count(3)
                ->state(["pseudo" => "Testing Dude", "email" => "test@test.fr"])
                ->create();

            $response = $this->get('/api/posts');
            $response->assertStatus(200)
                ->assertJson([
                    "user_id" => $posts->user_id, "title" => $posts->tile, "content" => $posts->content
                ], $strict = false);
        }
    */
    // Marche pas!
    public function test_if_no_data()
    {
        $response = $this->get('/api/posts');
        $response->assertNoContent($status = 204);
    }

    public function test_cant_get_post_if_invalid_id()
    {
        $response = $this->get('/api/posts/2000');
        $response->assertStatus(404);
    }

}
