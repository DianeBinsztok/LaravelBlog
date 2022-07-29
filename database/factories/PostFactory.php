<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
            'title' => fake()->sentence(),
            'content' => fake()->text(2000),
            'user_id' => User::inRandomOrder()->first(),
            'created_at' => fake()->dateTimeBetween('-1 week'),
        ];
    }
}
