<?php

use App\Http\Controllers\CardController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\PostUserController;
use App\Http\Controllers\ProfileController;
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

Route::get('cards/recent', [CardController::class, 'getRecent']);
Route::get('cards/popular', [CardController::class, 'getPopular']);

/**
 * POST CONTROLLER ROUTES
 */
// TODO : CREATE CONTROLLER, OBJECT BINDING MODEL,  RETURN POST DATA WITH MESSAGES. 
Route::get('posts/{post}', [PostController::class, 'show']);
Route::post('posts/like', [PostController::class, 'like']);
Route::post('posts/store', [PostController::class, 'store']);
Route::delete('posts/{post}', [PostController::class, 'destroy']);


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



/**
 * PROFILE PIC UPLOAD ROUTE
 */

 Route::post('/profiles/save-image', [FileController::class, 'store']);

require __DIR__ . '/auth.php';
