<?php

namespace Database\Factories;

use App\Models\Post;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentFactory extends Factory
{
    public function definition()
    {
        return [
            'content' => fake()->text(200),
            'email'=> User::factory(),
            'user_id' => User::factory(),
            'post_id' => Post::factory()
        ];
    }
}
