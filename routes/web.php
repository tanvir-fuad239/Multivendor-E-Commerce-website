<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Vendor\VendorController;
use App\Http\Controllers\Frontend\FrontendController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Backend\BrandController;
use App\Http\Controllers\Backend\CategoryController;
use App\Http\Controllers\Backend\SubCategoryController;
use App\Http\Controllers\Backend\ProductController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('index');
// });

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');



 
// frontend 
Route::controller(FrontendController::class)->name('frontend.')->group(function(){

    Route::get('/', 'index')->name('home');
    Route::get('/all-categories', 'getAllCategories')->name('all-categories');
    Route::get('/display-categories-with-products', 'displayCategoriesWithProducts')->name('display-categories');
    Route::get('/related-product/{product_id}/{category_id}', 'relatedProduct')->name('related-product');
    Route::get('/food-categories', 'getFoodCategories')->name('food-categories');
    Route::get('/hot-deals', 'getAllHotProducts')->name('hot-products');
    Route::get('/all-banners', 'getAllBanners')->name('all-banners');
    Route::get('/category-list', 'categoryList')->name('category.all');
    Route::get('/product-list/{category_id}/', 'productList')->name('product.all');
    Route::get('/product-details/{product_id}/', 'productDetails')->name('product-details');
    Route::get('/vendor-details', 'vendorDetails')->name('vendor.details');

    // cart
    Route::get('/add-to-cart/{product_id}/', 'addToCart')->name('add-to-cart');
    Route::get('/view-cart', 'viewCart')->name('view-cart');
    Route::get('/clear-cart', 'clearCart')->name('clear-cart');
    Route::get('/remove-product/{product_id}/', 'removeProductFromCart')->name('remove-product');
    Route::get('/product-increase/{product_id}/', 'productIncrese')->name('product-increase');
    Route::get('/product-decrease/{product_id}/', 'productDecrese')->name('product-decrease');


});


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
