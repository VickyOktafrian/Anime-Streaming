<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('shows/show-details/{id}', [App\Http\Controllers\Anime\AnimeController::class, 'animeDetails'])->name('anime.details');
Route::post('shows/insert-comments/{id}', [App\Http\Controllers\Anime\AnimeController::class, 'insertComments'])->name('anime.insert.comments');
Route::post('shows/follows/{id}', [App\Http\Controllers\Anime\AnimeController::class, 'follow'])->name('anime.follow');
Route::post('shows/views/{id}', [App\Http\Controllers\Anime\AnimeController::class, 'view'])->name('anime.view');

Route::get('shows/anime-watching/{show_id}/{episode_name}', [App\Http\Controllers\Anime\AnimeController::class, 'animeWatch'])->name('anime.watch');

Route::get('shows/category/{category_name}', [App\Http\Controllers\Anime\AnimeController::class, 'category'])->name('anime.category');

Route::get('users/followed-shows', [App\Http\Controllers\Users\UsersController::class, 'followedShows'])->name('users.followed.shows');

Route::any('shows/search', [App\Http\Controllers\Anime\AnimeController::class, 'searchShows'])->name('anime.search.shows');