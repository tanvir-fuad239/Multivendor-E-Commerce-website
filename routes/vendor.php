<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Vendor\VendorController;


// vendor with middleware
Route::middleware(['auth', 'role:vendor'])->group(function(){
    Route::controller(VendorController::class)->group(function(){
        Route::get('/vendor/dashboard', 'vendor_dashboard')->name('vendor.dashboard');
        Route::get('/vendor/profile', 'vendor_profile')->name('vendor.profile');
        Route::post('/vendor/profile/update', 'vendor_profile_update')->name('vendor.profile.update');
        Route::get('/vendor/change/password', 'vendor_change_password' )->name('vendor.change.password');
        Route::post('/vendor/update/password', 'vendor_update_password')->name('vendor.update.password');
        Route::get('/vendor/logout', 'vendor_logout')->name('vendor.logout');
    });
});

// vendor login 
Route::controller(VendorController::class)->group(function(){

    Route::get('/vendor/login', 'vendor_login')->name('vendor.login');
    Route::get('/vendor/register', 'vendor_register')->name('vendor.register');
    Route::post('/vendor/store', 'vendor_store')->name('vendor.store');

});
