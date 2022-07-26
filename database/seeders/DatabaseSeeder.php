<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        User::factory(10)->create();
        Post::factory(5)->create();
        Comment::factory(3)->create();

        // Peut-on garder cet exemple en plus?
        User::factory()->create([
        'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
