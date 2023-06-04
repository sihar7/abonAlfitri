<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\Auth\{
    AuthController
};

use App\Http\Controllers\LandingPage\{
    HomeController
};
use App\Http\Controllers\Product\{
    ProductController,
    WishlistController
};

use App\Http\Controllers\Payment\PaymentCallbackController;



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

// Auth
Route::get('/login', [AuthController::class, 'index'])->name('login');
Route::get('/register', [AuthController::class, 'register'])->name('register');
Route::post('/postLogin', [AuthController::class, 'postLogin']);
Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/', [HomeController::class, 'index'])->name('landingPage.home');
Route::get('/shop', [HomeController::class, 'shop'])->name('landingPage.shop');
Route::get('/story', [HomeController::class, 'about'])->name('landingPage.about');
Route::get('/virtualOutlet', [HomeController::class, 'virtualOutlet'])->name('landingPage.virtual');

Route::group(['middleware' => ['web', 'auth', 'has_login']], function () {
    Route::prefix('admin')->group(function() {
        
    });

    Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('landingPage.wishlist');
    Route::post('favorite-add/{id}', [WishlistController::class, 'favoriteAdd'])->name('favorite.add');
    Route::delete('favorite-remove/{id}', [WishlistController::class, 'favoriteRemove'])->name('favorite.remove');
    Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);
});