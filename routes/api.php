<?php

use App\Http\Controllers\Api\v1\LikeController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


Route::prefix('v1')->middleware(["auth:sanctum"])->group(function () {
    //
});