<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        // get the articles with their relations to avoid unnecessary queries
        $articles = Article::with('user')
            ->inRandomOrder()
            ->withCount('comments')
            ->withCount("article_likes")
            ->paginate(6);

        $tags = Tag::inRandomOrder()->limit(5)->get();

        return view('blog.home', compact('articles', 'tags'));
    }
}
