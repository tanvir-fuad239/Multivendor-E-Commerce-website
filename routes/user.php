<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\UserController;
 


// user 
Route::middleware(['auth','verified'])->group(function(){
    Route::controller(UserController::class)->group(function(){
        Route::get('/dashboard', 'user_dashboard')->name('dashboard');
        Route::post('/user/account/update', 'user_account_update')->name('user.account.update');
        Route::get('/user/password/change', 'user_password_change')->name('user.password.change');
        Route::post('/user/password/update', 'user_password_update')->name('user.password.update');
        Route::get('/user/logout', 'user_logout')->name('user.logout');
    });
});