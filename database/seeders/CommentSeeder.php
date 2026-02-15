<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Comment;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $articles = Article::all();

        foreach (range(1, 150) as $_) {
            Comment::factory()->create([
                'user_id' => $users->random()->id,
                'article_id' => $articles->random()->id,
            ]);
        }
    }
}
