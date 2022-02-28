<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\DisplayController;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PostUserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SearchController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

/**
 * Cards fetching routes
 */

Route::controller(CardController::class)->group(function(){

    Route::get('cards/recent',  'getRecent');
    Route::get('cards/popular', 'getByPopular');
    Route::get('cards/{user}', 'getByUser');

});


/**
 * POST CONTROLLER ROUTES
 */

Route::controller(PostController::class)->group(function(){
    
    Route::get('posts/{post}', 'show');
    Route::post('posts/like',  'like');
    Route::post('posts/store', 'store');
    Route::delete('posts/{post}', 'destroy');
    Route::get('posts/edit/{post}',  'edit');
    Route::post('posts/update/{post}',  'update');
});



/**
 * COMMENTS CONTROLLER ROUTES
 */

Route::post('comments/store', [CommentController::class, 'store']);
Route::delete('comments/{comment}', [CommentController::class, 'destroy']);

/**
 * LIKES ROUTE
 */

Route::post('likes/{post}', [PostUserController::class, 'store']);


/**
 * PROFILE CONTROLLERS ROUTES
 */

Route::get('profiles/{user}', [ProfileController::class, 'index']);
Route::post('profiles/update/{user}', [ProfileController::class, 'update']);



/**
 * PROFILE PIC UPLOAD ROUTE
 */

Route::post('/profiles/save-image', [FileController::class, 'store']);


/**
 * SHOW ALL CARDS/STORMS ROUTES
 */

Route::get('newest', [DisplayController::class, 'newest'])->name('newest');
Route::get('voted', [DisplayController::class, 'popular'])->name('voted');

/**
 * LIVE SEATCH
 */

Route::get('/livesearch', [SearchController::class, 'liveSearch']);

/**
 * MAIL ROUTES
 */

Route::post('/reports', [EmailController::class, 'sendReport']);

/**
 * ADMIN PANEL ROUTES // TODO : CREATE ADMIN MIDDLWARE
 *
 */

Route::group(['middleware' => 'admin'], function () {

    Route::get('/admin', function () {
        return Inertia::render('Admin');
    });

    Route::get('/admin/users', [AdminController::class, 'listUsers'])->name('users');
    Route::get('/admin/stacks', [AdminController::class, 'listStacks'])->name('stacks');
    Route::post('/admin/users', [AdminController::class, 'createUser']);
    Route::post('/admin/stacks', [AdminController::class, 'createStack']);
    Route::delete('/admin/users/{user}', [AdminController::class, 'deleteUser']);
    Route::delete('/admin/stacks/{stack}', [AdminController::class, 'deleteStack']);
});

require __DIR__ . '/auth.php';
