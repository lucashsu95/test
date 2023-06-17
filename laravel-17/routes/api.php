<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::prefix('auth')->group(function () {
    Route::post('/register', [\App\Http\Controllers\AuthController::class, 'register']); // 2
    Route::post('/login', [\App\Http\Controllers\AuthController::class, 'login']); // 1
    Route::middleware('check.token')->group(function () {
        Route::post('/logout', [\App\Http\Controllers\AuthController::class, 'logout']); // 3
    });
});
Route::prefix('images')->group(function () {
    Route::get('/search', [\App\Http\Controllers\ImageController::class, 'search']); // 4
    Route::get('/popular', [\App\Http\Controllers\ImageController::class, 'popular']); // 5
    Route::post('/upload', [\App\Http\Controllers\ImageController::class, 'upload']); // 7
    Route::prefix('{image_id')->group(function () {
        Route::put('/', [\App\Http\Controllers\ImageController::class, 'put']); // 8
        Route::get('/', [\App\Http\Controllers\ImageController::class, 'get']); // 9
        Route::delete('/', [\App\Http\Controllers\ImageController::class, 'delete']); //10

        Route::prefix('comments')->group(function () {
            Route::get('/', [\App\Http\Controllers\ImageController::class, 'getComment']);
            Route::post('/', [\App\Http\Controllers\ImageContrloller::class, 'postComment']);
        });
    });
});
Route::prefix('users')->group(function () {
    Route::prefix('{user_id}')->group(function () {
        Route::get('/images', [\App\Http\Controllers\UserController::class, 'getImage']); // 6
    });
});

Route::prefix('comments')->group(function () {
    Route::prefix('{comment_id}')->group(function () {
        Route::delete('/', [\App\Http\Controllers\CommentController::class, 'delete']);
    });
});

