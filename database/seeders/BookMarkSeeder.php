<?php

namespace Database\Seeders;

// use App\Models\Article;
// use App\Models\Bookmark;
// use App\Models\User;
// use Illuminate\Database\Seeder;

// class BookmarkSeeder extends Seeder
// {
//     /**
//      * Run the database seeds.
//      */
//     public function run(): void
//     {
//         $users = User::all();
//         $articles = Article::all();

//         $pairs = collect()->times(80, fn() => [
//             $users->random()->id,
//             $articles->random()->id,
//         ])->unique(fn(array $p) => "{$p[0]}_{$p[1]}");

//         foreach ($pairs as [$userId, $articleId]) {
//             Bookmark::firstOrCreate(
//                 ['user_id' => $userId, 'article_id' => $articleId],
//                 ['user_id' => $userId, 'article_id' => $articleId]
//             );
//         }
//     }
// }

use App\Models\User;
use App\Models\Article;
use Illuminate\Database\Seeder;

class BookmarkSeeder extends Seeder
{
    public function run(): void
    {
        $users = User::all();
        $articles = Article::all();

        $pairs = collect()->times(80, fn() => [
            'user_id' => $users->random()->id,
            'article_id' => $articles->random()->id,
        ])->unique(fn($p) => "{$p['user_id']}_{$p['article_id']}");

        foreach ($pairs as $pair) {
            $user = $users->firstWhere('id', $pair['user_id']);

            $user->bookmarks()->syncWithoutDetaching($pair['article_id']);
        }
    }
}