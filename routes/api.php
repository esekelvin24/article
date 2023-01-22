<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/




Route::prefix('v1')->group(function () {





    Route::middleware('api.gateway')->group(function () {

        Route::post('/articles/{id}/comments', [App\Http\Controllers\api\v1\ArticleController::class, 'store_comments'])->name('store_comments');

        //Route::apiResource('articles',App\Http\Controllers\api\v1\ArticleController::class);
        Route::get('/articles/{id}/likes', [App\Http\Controllers\api\v1\ArticleController::class, 'show_likes'])->name('show_likes');
        Route::get('/articles/{id}/views', [App\Http\Controllers\api\v1\ArticleController::class, 'show_views'])->name('show_view');

        Route::put('/articles/{id}/likes', [App\Http\Controllers\api\v1\ArticleController::class, 'likes_article'])->name('likes_article');
        Route::put('/articles/{id}/views', [App\Http\Controllers\api\v1\ArticleController::class, 'view_article'])->name('view_a_article');

        Route::get('/articles', [App\Http\Controllers\api\v1\ArticleController::class, 'index'])->name('articles');
        Route::post('/articles', [App\Http\Controllers\api\v1\ArticleController::class, 'store'])->name('store_articles');

        Route::get('/articles/{id}', [App\Http\Controllers\api\v1\ArticleController::class, 'show'])->name('show_article');

        Route::get('/articles/{id}/comments', [App\Http\Controllers\api\v1\ArticleController::class, 'show_comments'])->name('show_comment');



    });
});
