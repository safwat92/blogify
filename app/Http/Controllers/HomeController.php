<?php

namespace App\Http\Controllers;

use App\Models\Tag;
use App\Models\Article;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $query = Article::query();
        $order = $request->get('order') == "descending" ? "desc" : "asc";

        if ($request->has('sort')) {
            switch ($request->sort) {
                case 'reach':
                    $query->orderBy("views_count", $order);
                    break;
                case 'latest':
                    $query->orderBy("updated_at", $order);
                    break;
                default:
                    break;
            }
        }

        if ($request->has('tag')) {
            $query->whereHas('tags', function ($query) use ($request) {
                $query->where("tag", $request->get('tag'));
            });
        }

        if (!$request->has("sort") && !$request->has('tag')) {
            $query->inRandomOrder();
        }

        if ($request->has('search')) {
            $articles = $query->where('title', 'like', '%' . $request->get('search') . '%')
            ->orWhereHas('user', function ($query) use ($request) {
                $query->where('full_name', 'like', '%' . $request->get('search') . '%');
            });
        }

        $articles = $query->with('user')
            ->withCount('comments')
            ->withCount("article_likes")
            ->paginate(20)->withQueryString();

        $selectedTag = Tag::where("tag", $request->get('tag'))->get();

        $randomTags = Tag::limit(5)->get();

        $tags =  $selectedTag->merge($randomTags);

        return view('blog.home', compact('articles', 'tags'));
    }
}
