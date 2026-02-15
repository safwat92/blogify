<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Article>
 */
class ArticleFactory extends Factory
{
    protected $model = Article::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'title' => fake()->sentence(rand(4, 10)),
            'description' => fake()->paragraph(rand(3, 5)),
            'body' => fake()->text(2000),
            'cover_image' => 'cover.png',
            'views_count' => fake()->numberBetween(0, 10000),
        ];
    }
}
