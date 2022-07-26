<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class CommentFactory extends Factory
{
    public function definition()
    {
        return [
            'author_alias'=>fake()->name(),
            'date' => fake()->date(),
            'content' => fake()->text(200),
            'user_id' => fake()->randomNumber(),
        ];
    }
}
