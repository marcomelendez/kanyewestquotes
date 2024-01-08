<?php

use App\Http\Controllers\Admin\UserController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;


Route::middleware('auth.admin')->group(function(){
    Route::get('/users', [UserController::class,'index'])->name('admin.users');
});
