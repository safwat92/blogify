<?php

namespace Database\Seeders;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Seeder;
use Illuminate\Support\Arr;

class TagSeeder extends Seeder
{
    private array $tags = [
        'laravel', 'php', 'javascript', 'vue', 'react', 'tailwind', 'sql',
        'api', 'backend', 'frontend', 'devops', 'testing', 'security',
        'performance', 'database', 'redis', 'docker', 'git',
    ];

    /**
     * Run the database seeds.
     */
    public function run()
    {
        Tag::factory()->count(10)->create();

        $tags = Tag::all();

        Article::all()->each(function ($article) use ($tags) {

            $randomTags = $tags->random(rand(1, 3))->pluck('id');

            $article->tags()->attach($randomTags);

        });
    }
}
