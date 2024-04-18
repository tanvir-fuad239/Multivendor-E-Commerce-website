<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;
use App\Http\Controllers\Backend\HeroSliderController;
use  App\Http\Controllers\Backend\BannerController;

// admin with middleware
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin/dashboard', 'admin_dashboard')->name('admin.dashboard');
        Route::get('/admin/profile', 'admin_profile')->name('admin.profile');
        Route::post('/admin/profile/update', 'admin_profile_update')->name('admin.profile.update');
        Route::get('/admin/change/password', 'admin_change_password')->name('admin.change.password');
        Route::post('/admin/update/password', 'admin_update_password')->name('admin.update.password');
        Route::get('/admin/logout', 'admin_logout')->name('admin.logout');
        Route::get('/vendor/active', 'vendor_active')->name('vendor.active');
        Route::get('/vendor/inactive', 'vendor_inactive')->name('vendor.inactive');
        Route::get('/vendor/active-to-inactive/{id}', 'vendor_active_to_inactive')->name('active.to.inactive');
        Route::get('/vendor/inactive-to-active/{id}', 'vendor_inactive_to_active')->name('inactive.to.active');
        Route::post('/active/vendor-info/udpate/{id}', 'active_vendor_info_update')->name('active.vendor.info.update');
        Route::post('/inactive/vendor-info/udpate/{id}', 'inactive_vendor_info_update')->name('inactive.vendor.info.update');
        Route::get('/active/vendor/delete/{id}', 'active_vendor_delete')->name('active.vendor.delete');
        Route::get('/inactive/vendor/delete/{id}', 'inactive_vendor_delete')->name('inactive.vendor.delete');
    });
});

// admin login
Route::controller(AdminController::class)->group(function(){

    Route::get('/admin/login', 'admin_login')->name('admin.login');

});

// admin brand 
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::controller(BrandController::class)->group(function(){
        Route::get('/add/brand', 'create')->name('brand.add');
        Route::post('/store/brand', 'store')->name('brand.store');
        Route::get('/all/brand', 'index')->name('brand.all');
        Route::get('/edit/brand/{id}', 'edit')->name('brand.edit');
        Route::post('/update/brand/{id}', 'update')->name('brand.update');
        Route::get("/brand/delete{id}", 'destroy')->name('brand.delete');
    });
});

// admin category 
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::controller(CategoryController::class)->group(function(){
        Route::get('/add/category', 'create')->name('category.add');
        Route::post('/store/category', 'store')->name('category.store');
        Route::get('/all/category', 'index')->name('category.all');
        Route::get('/edit/category/{id}', 'edit')->name('category.edit');
        Route::post('/update/category/{id}', 'update')->name('category.update');
        Route::get('/category/delete/{id}', 'destroy')->name('category.delete');
    });
});

// admin sub category 
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::controller(SubCategoryController::class)->group(function(){
       Route::get('/add/subcategory', 'create')->name('subcategory.add');
       Route::post('/store/subcategory', 'store')->name('subcategory.store');
       Route::get('/all/subcategory', 'index')->name('subcategory.all');
       Route::get('/edit/subcategory/{id}', 'edit')->name('subcategory.edit');
       Route::post('/update/subcategory/{id}', 'update')->name('subcategory.update');
       Route::get('/delete/subcategory/{id}', 'destroy')->name('subcategory.delete');
    });
});

// admin product 
Route::middleware(['auth', 'role:admin'])->group(function(){
    Route::controller(ProductController::class)->name('product.')->prefix('/admin/product')->group(function(){
        Route::get('/add/', 'create')->name('create');
        Route::post('/store/', 'store')->name('store');
        Route::get('/all/', 'index')->name('all');
        Route::get('/show/{id}/', 'show')->name('show');
        Route::get('/edit/{id}/', 'edit')->name('edit');
        Route::post('/update/{id}/', 'update')->name('update');
        Route::get('/delete/{id}/', 'destroy')->name('destroy');
        Route::get('/get/subcategory/{category_id}/', 'getSubCategory');
        Route::get('/inactivate/{id}/{status}/', 'productStatus')->name('inactive');
        Route::get('/activate/{id}/{status}/', 'productStatus')->name('active');
        Route::get('/sort/{key}/', 'index')->name('sort');
        Route::get('/filter/{min}/{max}/', 'productFilter')->name('filter');
    });
}); 

// hero sliders
Route::middleware(['auth', 'role:admin'])->prefix('/admin/')->name('admin.')->group(function(){
    Route::resource('hero-sliders', HeroSliderController::class);
    Route::get('slider/status/{id}/', [HeroSliderController::class, 'sliderToggle'])->name('slder-toggle');
});

// banner
Route::middleware(['auth', 'role:admin'])->name('admin.')->prefix('/admin/')->group(function(){
    Route::resource('banners', BannerController::class);
});

