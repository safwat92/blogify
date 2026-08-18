<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ArticleController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookmarkController;


Route::middleware(['auth','verified'])->group(function () {
    //admin

    // blog
    Route::get("/", [HomeController::class, 'index'])->name("blog");
    Route::resource("profile", ProfileController::class)->only("index","update");
    Route::get("/profile/bookmarks", [ProfileController::class, 'showBookmarks'])->name("show-bookmarks");
    Route::get("/article/create", [ArticleController::class, "createArticleView"])->name("create-article");
    Route::post("/article/create", [ArticleController::class, "createArticle"])->name("create-article");
    Route::get("/article/{article_id}", [ArticleController::class, "showArticle"])->name("show-article");
    Route::post("/article/{article_id}/like", [ArticleController::class, 'likeArticle']);
    Route::post("/article/{article_id}/bookmark", [ArticleController::class, 'bookmarkArticle']);
    Route::resource('/article/{article_id}/comment', CommentController::class)->only('store','update','destroy');
    Route::post("/comment/{comment}/like", [CommentController::class, 'likeComment'])->name('comment.like');
});

require __DIR__.'/auth.php';
