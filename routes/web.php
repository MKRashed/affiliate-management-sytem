<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AffiliateController;
use App\Http\Controllers\Affiliate\AffiliateController as MainAffiliateController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TransactionController;
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

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('transcations', TransactionController::class);
});

require __DIR__.'/auth.php';

Route::middleware(['auth:admin', 'verified'])->group(function () {
    Route::prefix('/admin')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'index'])->name('admin.dashboard');
        Route::resource('affiliates', AffiliateController::class);
    });

});

require __DIR__.'/adminauth.php';

Route::middleware(['auth:affiliate', 'verified'])->group(function () {
    Route::prefix('/affiliate')->group(function () {
        Route::get('/dashboard', [MainAffiliateController::class, 'index'])->name('affiliate.dashboard');
        Route::get('/create', [ MainAffiliateController::class, 'create'])->name('affiliate.create');
        Route::post('/sub-affiliate', [ MainAffiliateController::class, 'store'])->name('sub-affiliate');
    });

});

require __DIR__.'/affiliateauth.php';
