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
    OrderController,
    CartController,
    CityController
};

use App\Http\Controllers\Payment\{
    PaymentCallbackController,
    CheckoutController,
    InvoiceController
};



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
Route::post('/postRegister', [AuthController::class, 'postRegister']);
Route::get('/logout', [AuthController::class, 'logout']);

Route::get('/', [HomeController::class, 'index'])->name('landingPage.home');
Route::get('/shop', [HomeController::class, 'shop'])->name('landingPage.shop');
Route::get('/story', [HomeController::class, 'about'])->name('landingPage.about');
Route::get('/virtualOutlet', [HomeController::class, 'virtualOutlet'])->name('landingPage.virtual');

Route::get('/product/modal/{id}', [ProductController::class, 'getData']);
Route::get('search', [ProductController::class, 'search']);


Route::get('/getKabupaten/{id}', [CityController::class, 'getKabupaten']);
Route::get('/getKecamatan/{id}', [CityController::class, 'getKecamatan']);
Route::get('/getKelurahan/{id}', [CityController::class, 'getKelurahan']);

Route::prefix('cart')->group(function() {
    Route::get('/', [CartController::class, 'index']);
    Route::get('/index', [CartController::class, 'index']);
    Route::post('/buy/{id}', [CartController::class, 'buy']);
    Route::post('/buyButton', [CartController::class, 'buyButton']);
    Route::get('/remove/{id}', [CartController::class, 'remove']);
    Route::get('/removeTroli/{id}', [CartController::class, 'removeTroli']);
    Route::post('/update', [CartController::class, 'update']);
    Route::get('/clearAll', [CartController::class, 'clearAll']);
});

Route::group(['middleware' => ['web', 'auth', 'has_login']], function () {
    Route::prefix('admin')->group(function() {
        
    });

    Route::resource('orders', OrderController::class)->only(['index', 'show']);
    Route::post('payments/midtrans-notification', [PaymentCallbackController::class, 'receive']);
    // Route::get('/wishlist', [WishlistController::class, 'wishlist'])->name('landingPage.wishlist');
    // Route::post('favorite-add/{id}', [WishlistController::class, 'favoriteAdd'])->name('favorite.add');
    // Route::delete('favorite-remove/{id}', [WishlistController::class, 'favoriteRemove'])->name('favorite.remove');

    Route::prefix('account')->group(function() {
        Route::get('/', [AuthController::class, 'account']);
        Route::post('change-password', [AuthController::class, 'changePassword'])->name('change.password');
        Route::get('/invoice/generate/{idOrder}', [InvoiceController::class, 'generate']);
        
    });

    Route::prefix('checkout')->group(function() {
        Route::get('/', [CheckoutController::class, 'checkout']);
        Route::post('/postCheckout', [CheckoutController::class, 'postCheckout']);
    });
});