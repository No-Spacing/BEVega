<?php

use Illuminate\Support\Facades\Route;

use Inertia\Inertia;

use App\Http\Controllers\AdminController;


Route::get('/', function () {
    return redirect('/login');
});

   
Route::post('/PostLogin', [AdminController::class, 'PostLogin'])->name('post.login');
Route::post('/PostUser', [AdminController::class, 'RegisterUser']);

Route::middleware(['admin'])->group(function () {

    Route::inertia('/login', 'Auth/Login')->name('/login');
    
    Route::inertia('/register', 'Auth/Register')->name('/register');

    Route::inertia('/create-product', 'CreateProduct');

    Route::inertia('/videos', 'Videos');

    Route::controller(AdminController::class)->group( function () {
        Route::get('/dashboard', 'Dashboard');

        Route::get('/products', 'Products');

        Route::post('/post-product','PostProduct');

        Route::delete('/delete-product/{id}', 'DeleteProduct');

        Route::put('/update-product', 'UpdateProduct');

        Route::get('/videos/{title}', 'VideoPlayer');

        Route::get('/logout', 'logout'); 
    });
    
});

