<?php

use App\Http\Controllers\Customer\CartController;
use App\Http\Controllers\Customer\CategoryController;
use App\Http\Controllers\Customer\CheckoutController;
use App\Http\Controllers\Customer\FoodController;
use App\Http\Controllers\Customer\HomeController;
use App\Http\Controllers\Customer\MenuController;
use App\Http\Controllers\Customer\OrderController;
use App\Http\Controllers\Customer\WalletController;
use App\Http\Controllers\Customer\SearchController;
use Illuminate\Support\Facades\Route;



Route::middleware(['auth'])->prefix('customer')->group(function () {
    Route::resource('/home', HomeController::class);

    Route::resource('/menu', MenuController::class);

    Route::resource('/category', CategoryController::class);

    Route::get('/foods/{id}/details', [FoodController::class, 'getDetails'])->name('foods.details');

    Route::resource('/cart', CartController::class)->only(['index', 'store']);
    Route::controller(CartController::class)->group(function () {
        Route::post('cart/update', 'update')->name('cart.update');
        Route::delete('cart/remove', 'remove')->name('cart.remove');
        Route::delete('cart/clear', 'clear')->name('cart.clear');
        Route::post('/cart/meta', 'saveMeta')->name('cart.meta.store');
        Route::post('/cart/meta/clear', [CartController::class, 'clearMeta'])->name('cart.meta.clear');

    });

    Route::resource('/checkout', CheckoutController::class);

    Route::resource('/myorders', OrderController::class);

    Route::resource('/menu', MenuController::class);

    Route::resource('/wallet', WalletController::class);
    Route::post('/wallet/topup', [WalletController::class, 'topup'])->name('wallet.topup');

    Route::get('/profile', function () {
        return view('Customer.pages.profile');
    })->name('customer.profile');

    Route::get('/like', function () {
        return view('Customer.pages.like');
    })->name('like');

    Route::get('/refer', function () {
        return view('Customer.pages.refer');
    })->name('refer');

    Route::get('/notifications', function () {
        return view('Customer.pages.notifications');
    })->name('notifications');

    Route::get('/coupons', function () {
        return view('Customer.pages.coupons');
    })->name('coupons');

    Route::get('/loyalty', function () {
        return view('Customer.pages.loyalty');
    })->name('loyalty');

    Route::get('/track', function () {
        return view('Customer.pages.track');
    })->name('track');

    Route::get('/reviews', function () {
        return view('Customer.pages.reviews');
    })->name('reviews');

    Route::get('/discover', function () {
        return view('Customer.pages.discover');
    })->name('discover');

    Route::delete('/customer/delete-account', function () {
        return back()->with('status', 'Dummy: Account deleted (simulasi).');
    })->name('customer.delete-account');

    Route::get('/cart/meta/qty', [CartController::class, 'getQty'])->name('cart.meta.qty');

    Route::get('/search/suggestions', [SearchController::class, 'suggestions'])->name('search.suggestions');
});
