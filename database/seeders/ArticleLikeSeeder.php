<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\ArticleLike;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $articles = Article::all();

        $pairs = collect()->times(200, fn () => [
            $users->random()->id,
            $articles->random()->id,
        ])->unique(fn (array $p) => "{$p[0]}_{$p[1]}");

        foreach ($pairs as [$userId, $articleId]) {
            ArticleLike::firstOrCreate(
                ['user_id' => $userId, 'article_id' => $articleId],
                ['user_id' => $userId, 'article_id' => $articleId]
            );
        }
    }
}
