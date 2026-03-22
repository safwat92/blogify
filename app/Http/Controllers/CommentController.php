<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request, $article_id)
    {
        $commentBody = $request->validate(["body" => "required"]);
        $request->user()->comments()->create([
            "article_id" => $article_id,
            "body" => $commentBody["body"]
        ]);
        return redirect()->back();
    }

    public function likeComment(Comment $comment) {
        $userId = Auth::id();

        $userLikedArticle = $comment->comment_likes()->where("user_id", $userId);
        $isLiked = false;

        if (!$userLikedArticle->exists()) {
            $comment->comment_likes()->create([
                "user_id" => Auth::id(),
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

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
