<?php

use Illuminate\Support\Facades\Route;

// Route untuk halaman utama

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index'])->name('index');
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

// Grouping routes dengan prefix 'shows'
Route::prefix('shows')->group(function () {
    Route::get('show-details/{id}', [App\Http\Controllers\Anime\AnimeController::class, 'animeDetails'])->name('anime.details');
    Route::post('insert-comments/{id}', [App\Http\Controllers\Anime\AnimeController::class, 'insertComments'])->name('anime.insert.comments');
    Route::post('follows/{id}', [App\Http\Controllers\Anime\AnimeController::class, 'follow'])->name('anime.follow');
    Route::post('views/{id}', [App\Http\Controllers\Anime\AnimeController::class, 'view'])->name('anime.view');
    Route::get('anime-watching/{show_id}/{episode_name}', [App\Http\Controllers\Anime\AnimeController::class, 'animeWatch'])->name('anime.watch');
    Route::get('category/{category_name}', [App\Http\Controllers\Anime\AnimeController::class, 'category'])->name('anime.category');
    Route::any('search', [App\Http\Controllers\Anime\AnimeController::class, 'searchShows'])->name('anime.search.shows');
});

// Grouping routes dengan prefix 'users'
Route::prefix('users')->group(function () {
    Route::get('followed-shows', [App\Http\Controllers\Users\UsersController::class, 'followedShows'])->name('users.followed.shows')->middleware('auth:web');
});
