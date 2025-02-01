<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\post;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Database\Factories\PostFactory;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $users = User::factory(10)->create();

        $posts = Post::factory(100)->recycle($users)->create();

        $comments = Comment::factory(200)->recycle($posts)->recycle($users)->create();

        User::factory()
            ->has(Post::factory(30))
            ->has( Comment::factory(200)->recycle($posts))
            ->create([
            'name' => 'Abdu',
            'email' => 'test@example.com',
        ]);
    }
}
