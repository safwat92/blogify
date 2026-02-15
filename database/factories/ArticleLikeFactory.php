<?php

namespace Database\Factories;

use App\Models\Article;
use App\Models\ArticleLike;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\ArticleLike>
 */
class ArticleLikeFactory extends Factory
{
    protected $model = ArticleLike::class;

    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'user_id' => User::factory(),
            'article_id' => Article::factory(),
        ];
    }
}
