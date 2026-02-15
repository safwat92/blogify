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
    public function run(): void
    {
        Article::all()->each(function (Article $article) {
            $count = rand(2, 5);
            $selected = Arr::random($this->tags, min($count, count($this->tags)));

            foreach ((array) $selected as $tag) {
                Tag::firstOrCreate(
                    ['article_id' => $article->id, 'tag' => $tag],
                    ['article_id' => $article->id, 'tag' => $tag]
                );
            }
        });
    }
}
