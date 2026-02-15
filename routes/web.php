<?php

use App\Http\Controllers\ArticleController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth','verified'])->group(function () {
    Route::get("/", [HomeController::class, 'index'])->name("blog");
    Route::get("/profile", [ProfileController::class, 'index'])->name("profile");
    Route::post("/profile", [ProfileController::class, 'updateProfileInfo'])->name("update-profile");
    Route::resource("/article", ArticleController::class);
    Route::resource("/bookmarks", BookmarkController::class);
    Route::resource('/comment', CommentController::class)->only('store','update','destory');
});

require __DIR__.'/auth.php';
