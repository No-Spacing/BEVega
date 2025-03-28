<?php

use Illuminate\Support\Facades\Route;

use Inertia\Inertia;

use App\Http\Controllers\AdminController;


Route::post('/PostLogin', [AdminController::class, 'PostLogin'])->name('post.login');

Route::post('/register-user', [AdminController::class, 'RegisterUser']);

Route::middleware(['admin'])->group(function () {

    Route::inertia('/login', 'Auth/Login');

    Route::inertia('/register', 'Auth/Register');

    Route::get('/dashboard', [AdminController::class, 'Dashboard']);
     
    Route::get('/products', [AdminController::class, 'Products']);
    
    Route::inertia('/create-product', 'CreateProduct');
    Route::post('/post-product', [AdminController::class, 'PostProduct']);

    Route::delete('/delete-product/{id}', [AdminController::class, 'DeleteProduct']);

    Route::put('/update-product', [AdminController::class, 'UpdateProduct']);

    Route::inertia('/videos', 'Videos');

    Route::get('/videos/{title}', [AdminController::class, 'VideoPlayer']);

    Route::get('/logout', [AdminController::class, 'logout']); 
});

