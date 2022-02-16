<?php

use App\Http\Controllers\CardController;
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
 * Post with comments view
 */
// TODO : CREATE CONTROLLER, OBJECT BINDING MODEL,  RETURN POST DATA WITH MESSAGES. 
Route::get('posts/{id}', function($id){
    
    return Inertia::render('Post', [
        'post' => [
            'id' => $id,
        ]
    ]);
});

require __DIR__.'/auth.php';
