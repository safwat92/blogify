<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index() {
        $userArticles = Auth::user()->load('articles.article_likes', 'articles.comments');
        $articles = $userArticles->articles;
        $views = $userArticles->articles->sum('views_count');
        $likes = $userArticles->article_likes->count();
        $comments = $userArticles->comments->count();
        return view("blog.profile", compact('articles','views','likes','comments'));
    }
    public function updateProfileInfo(UpdateProfileRequest $request) {
        $cred = $request->validated();
        $user = Auth::user();
        $user->update($cred);
        return redirect()->back();
    }
}
