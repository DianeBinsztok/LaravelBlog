<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

class CommentFactory extends Factory
{
    public function definition()
    {
        if (rand(0, 1) == 1) {
            return [
                'content' => fake()->text(200),
                'email' => fake()->email,
                'pseudo' => fake()->name,
                'post_id' => Post::inRandomOrder()->first(),
            ];
        } else {
            return [
                'content' => fake()->text(200),
                'user_id' => User::inRandomOrder()->first(),
                'post_id' => Post::inRandomOrder()->first(),
            ];
        }
    }
}
