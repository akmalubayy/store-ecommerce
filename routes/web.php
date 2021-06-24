<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\DetailController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\Auth\LogoutController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DashboardProductController;
use App\Http\Controllers\DashboardSettingController;
use App\Http\Controllers\CheckoutController;

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


// Route for Admin
Route::prefix('admin')
->namespace('Admin')
->middleware(['auth','admin'])
->group(function() {
   Route::get('/', 'DashboardController@index')->name('admin-dashboard');
   Route::resource('category', 'CategoryController');
   Route::resource('user', 'UserController');
   Route::resource('product', 'ProductController');
   Route::resource('gallery', 'ProductGalleryController');
   Route::resource('transaction', 'TransactionController');
});


// Middleware auth access
Route::group(['middleware' => ['auth']], function() {
    Route::get('/cart', [CartController::class, 'index'])->name('cart');
    Route::delete('/cart/{id}/delete', [CartController::class, 'delete'])->name('delete-product-cart');

    // Midtrans
    Route::post('/checkout', [CheckoutController::class, 'process'])->name('checkout');

    // Route dashboard for users

    // MyDashboard
    Route::get('/dashboard/', [DashboardController::class, 'index'])->name('dashboard');

    // My Dashboard Product (User)
    Route::get('/dashboard/products', [DashboardProductController::class,'index'])->name('dashboard-product');
    Route::get('/dashboard/products/create', [DashboardProductController::class,'create'])->name('dashboard-product-create');
    Route::post('/dashboard/products',[DashboardProductController::class, 'store'])->name('dashboard-product-store');
    Route::get('/dashboard/products/{id}', [DashboardProductController::class,'details'])->name('dashboard-product-details');
    Route::post('/dashboard/products/{id}' , [DashboardProductController::class, 'update'])->name('dashboard-product-update');
    // Route::post('/dashboard/products/delete/{id}', [DashboardProductController::class, 'delete'])->name('dashboard-product-delete');

    // Product Gallery upload (user)
    Route::post('/dashboard/products/gallery/upload', [DashboardProductController::class, 'uploadGallery'])->name('dashboard-product-gallery-upload');
    Route::get('/dashboard/products/gallery/delete/{id}', [DashboardProductController::class, 'deleteGallery'])->name('dashboard-product-gallery-delete');

    // My Transaction (User)
    Route::get('/dashboard/transaction', 'DashboardTransactionController@index')->name('dashboard-transactions');
    Route::get('/dashboard/transaction/{id}', 'DashboardTransactionController@details')->name('dashboard-transactions-details');
    Route::post('/dashboard/transaction/{id}', 'DashboardTransactionController@update')->name('dashboard-transactions-update');

    // Store and User Settings (User)
    Route::get('/dashboard/store/settings', [DashboardSettingController::class,'storeSetting'])->name('dashboard-store-settings');
    Route::get('/dashboard/account/settings', [DashboardSettingController::class, 'accountSetting'])->name('dashboard-account-settings');
    Route::post('/dashboard/account/{redirect}', [DashboardSettingController::class, 'update'])->name('dashboard-settings-redirect');
});


// Route home site
Route::get('/', 'HomeController@index')->name('home');
Route::get('/categories', [CategoryController::class, 'index'])->name('categories');
Route::get('/categories/{id}', [CategoryController::class, 'details'])->name('categories-detail');
Route::get('/details/{id}', [DetailController::class, 'index'])->name('detail');
Route::post('/details/{id}', [DetailController::class, 'add'])->name('add-product');




// Midtrans routes
Route::post('/checkout/callback', [CheckoutController::class, 'callback'])->name('midtrans-callback');

Route::get('/register/success' , [RegisterController::class, 'registerSuccess'])->name('register-success');


// Clear cache
Route::get('/clear-cache', function() {
    Artisan::call('cache:clear');
    return "Cache is cleared";
});


Auth::routes(['verify' => true]);
