<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class PostFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title'=> fake()->title(),
            'user'=> fake()->name(),
            'date' => fake()->date(),
            'content' => fake()->text(2000)
        ];
    }
}
