<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Seeder;

class ArticleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = User::all();

        foreach (range(1, 50) as $_) {
            Article::factory()->create(['user_id' => $users->random()->id]);
        }
    }
}
