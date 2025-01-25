<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admins\AdminsController;

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

Route::get('admin/login',[AdminsController::class,'viewLogin'])->name('view.login');
Route::post('admin/login',[AdminsController::class,'checkLogin'])->name('check.login');

Route::group(['prefix' => 'admin', 'middleware' => 'auth:admin'], function () {
    Route::get('/index', [AdminsController::class, 'index'])->name('admins.dashboard');
    Route::get('/all-admins', [AdminsController::class, 'allAdmins'])->name('admins.all');
    Route::get('/create-admins', [AdminsController::class, 'createAdmins'])->name('admins.create');
    Route::post('/create-admins', [AdminsController::class, 'storeAdmins'])->name('admins.store');
    
    
    Route::get('/all-shows', [AdminsController::class, 'allShows'])->name('shows.all');
    Route::get('/create-shows', [AdminsController::class, 'createShows'])->name('shows.create');
    Route::post('/create-shows', [AdminsController::class, 'storeShows'])->name('shows.store');
    Route::get('/delete-shows/{id}', [AdminsController::class, 'deleteShows'])->name('shows.delete');
    
    
    Route::get('/all-genre', [AdminsController::class, 'allGenre'])->name('genre.all');
    Route::get('/create-genre', [AdminsController::class, 'createGenre'])->name('genre.create');
    Route::post('/create-genre', [AdminsController::class, 'storeGenre'])->name('genre.store');
    Route::get('/delete-genre/{id}', [AdminsController::class, 'deleteGenre'])->name('genre.delete');
    

    Route::get('/all-episodes', [AdminsController::class, 'allEpisodes'])->name('episodes.all');
    Route::get('/create-episodes', [AdminsController::class, 'createEpisodes'])->name('episodes.create');
    Route::post('/create-episodes', [AdminsController::class, 'storeEpisodes'])->name('episodes.store');
    Route::get('/delete-episodes/{id}', [AdminsController::class, 'deleteEpisodes'])->name('episodes.delete');
});
Route::post('admin/logout', [AdminsController::class, 'logout'])->name('admins.logout');



