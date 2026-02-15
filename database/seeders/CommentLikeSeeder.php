<?php

namespace Database\Seeders;

use App\Models\Comment;
use App\Models\CommentLike;
use App\Models\User;
use Illuminate\Database\Seeder;

class CommentLikeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();
        $comments = Comment::all();

        $pairs = collect()->times(100, fn () => [
            $users->random()->id,
            $comments->random()->id,
        ])->unique(fn (array $p) => "{$p[0]}_{$p[1]}");

        foreach ($pairs as [$userId, $commentId]) {
            CommentLike::firstOrCreate(
                ['user_id' => $userId, 'comment_id' => $commentId],
                ['user_id' => $userId, 'comment_id' => $commentId]
            );
        }
    }
}
