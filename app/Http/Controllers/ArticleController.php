<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use App\Traits\ExtractArticleDetails;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ArticleController extends Controller
{
    use ExtractArticleDetails;
    public function createArticleView() {
        return view("blog.writeArticle");
    }

    public function createArticle(Request $request) {
        $title = $this->getTitle($request->input("content"));
        $description = $this->getDescription($request->input("content"));

        if (!$title || !$description) {
            return back()->withErrors([
                "error" => "title & description Not Found"
            ]);
        }

        $user = Auth::user();
        $user->articles()->create([
            "title" => $title,
            "description" => $description,
            "body" => $request->get("content"),
        ]);

        return redirect("/");
    }

    public function showArticle(string $id)
    {
        $article = Article::with(["comments.user", "comments" => function ($query) {
            $query->withCount(["comment_likes as is_liked" => function ($query) {
                $query->where("user_id", Auth::id());
            }]);
        }])
            ->withCount(["article_likes","comments","bookmarkedBy"])
            ->findOrFail($id);

        $isLiked = $article->article_likes() // try making a function in model instead
            ->where("user_id", Auth::id())
            ->exists();

        $isBookmarked = Auth::user()->bookmarks()->where('article_id', $id)->exists(); // the same

        $likesCount = $article->article_likes_count;
        $commentsCount = $article->comments_count;
        $bookmarksCount = $article->bookmarked_by_count;
        $comments = $article->comments;

        return view("blog.article", compact('article', 'comments','likesCount','commentsCount','bookmarksCount','isLiked', 'isBookmarked'));
    }

    public function likeArticle($articleId) {
        $userId = Auth::id();

        $article = Article::find($articleId);
        $userLikedArticle = $article->article_likes()->where("user_id", $userId);
        $isLiked = false;

        if (!$userLikedArticle->exists()) {
            $article->article_likes()->create([
                'user_id' => $userId,
            ]);
            $isLiked = true;
        } else {
            $userLikedArticle->delete();
            $isLiked = false;
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'currentStatus' => $isLiked,
        ]);
    }

    public function bookmarkArticle($articleId) {
        $user = Auth::user();

        $isBookmarked = false;
        if ($user->bookmarks()->where('articles.id', $articleId)->exists()) {
            $user->bookmarks()->detach($articleId);
            $isBookmarked = false;
        } else {
            $user->bookmarks()->attach($articleId);
            $isBookmarked = true;
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'currentStatus' => $isBookmarked,
        ]);
    }
}
