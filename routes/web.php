<?php

use App\Http\Controllers\CartController;
use App\Http\Controllers\FrontController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReviewController;
use App\Models\Order;
use Filament\Facades\Filament;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [FrontController::class, 'index'])->name('front.index');
Route::get('/product/{product:slug}', [FrontController::class, 'detailProduct'])->name('front.detail');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/order/{id}/view', function ($id) {
        $order = Order::with('products')->findOrFail($id); // Load order with related products
        return view('components.view-order', compact('order'));
    })->name('order.view');

    Route::post('/product/{product}/reviews', [ReviewController::class, 'store'])->name('reviews.store');


    // Route untuk menampilkan halaman Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    // Route untuk menambahkan produk ke Cart
    Route::post('/cart/add/{productId}', [CartController::class, 'add'])->name('cart.add');

    // Route untuk memperbarui jumlah produk di Cart
    Route::patch('/cart/update/{cartId}', [CartController::class, 'update'])->name('cart.update');

    // Route untuk menghapus produk dari Cart
    Route::delete('/cart/remove/{cartId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::get('/checkout', [PaymentController::class, 'checkout'])->name('payment.checkout');
});

Route::post('/payment/callback', [PaymentController::class, 'callback'])->name('payment.callback');
require __DIR__ . '/auth.php';
