<?php

use App\Http\Controllers\QuoteController;
use App\Http\Controllers\UserController;
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

Route::middleware(['auth','verified'])->group(function(){
    Route::get('/quotes', [QuoteController::class,'index'])->name('quotes');
    Route::get('/favorites',[QuoteController::class,'favorites'])->name('favorites');
    Route::delete('/favorites/{id}',[QuoteController::class,'destroy'])->name('favorites.destroy');

    Route::get('/profile',[UserController::class,'profile'])->name('profile');
    Route::put('/profile/{id}',[UserController::class,'updateProfile'])->name('profile.update');
});


require __DIR__.'/auth.php';
