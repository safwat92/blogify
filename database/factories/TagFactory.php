<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\Tag;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Tag>
 */
class TagFactory extends Factory
{
    protected $model = Tag::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $tags = [
            'laravel', 'php', 'javascript', 'vue', 'react', 'tailwind', 'sql',
            'api', 'backend', 'frontend', 'devops', 'testing', 'security',
            'performance', 'database', 'redis', 'docker', 'git',
        ];

        return [
            'tag' => fake()->randomElement($tags),
        ];
    }
}
