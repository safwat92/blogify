<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Traits\UploadFileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    use UploadFileTrait;
    public function index()
    {
        $articles = Auth::user()
            ->articles()
            ->withCount("comments") // count per article
            ->withCount("article_likes")
            ->paginate(20);

        $views = $articles->sum("views_count");
        $comments = $articles->sum('comments_count');
        $likes = $articles->sum('article_likes_count');

        return view("blog.profile", compact('articles', 'views', 'likes', 'comments'));
    }
    public function update(UpdateProfileRequest $request)
    {
        $cred = $request->validated();
        $new_profile = $this->uploadFile($request, "profile_image", "users");
        $user = Auth::user();
        $user->update([...$cred, 'profile_image' => $new_profile]);
        return redirect()->back();
    }

    public function showBookmarks()
    {
        $user = Auth::user();

        $articles = $user->articles()
            ->select(['id', 'title', 'views_count'])
            ->withCount(['comments', 'article_likes'])
            ->get();

        $views = $articles->sum('views_count');
        $comments = $articles->sum('comments_count');
        $likes = $articles->sum('article_likes_count');

        $bookmarks = $user->bookmarks()
            ->select(['articles.id', 'articles.title', 'articles.description', 'articles.user_id', 'articles.views_count'])
            ->with(['user:id,full_name,profile_image'])
            ->withCount(['comments', 'article_likes'])
            ->orderByDesc('bookmarks.created_at')
            ->paginate(20);

        return view("blog.bookmarks", compact('bookmarks', 'views', 'comments', 'likes'));
    }
}
