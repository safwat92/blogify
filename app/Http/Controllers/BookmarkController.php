<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Article;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class BookmarkController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            "article_id" => ["required", "exists:articles,id"],
        ]);

        $bookmarkId = $request->article_id;

        $user = Auth::user();      
          
        $isBookmarked = false;
        if ($user->bookmarks()->where('articles.id', $bookmarkId)->exists()) {
            $user->bookmarks()->detach($bookmarkId);
            $isBookmarked = false;
        } else {
            $user->bookmarks()->attach($bookmarkId);
            $isBookmarked = true;
        }

        return response()->json([
            'code' => 200,
            'status' => 'success',
            'currentStatus' => $isBookmarked,
        ]);
    }
}
