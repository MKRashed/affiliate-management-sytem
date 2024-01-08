<?php

use App\Http\Controllers\AffiliateAuth\ConfirmablePasswordController;
use App\Http\Controllers\AffiliateAuth\AuthenticatedSessionController;
use App\Http\Controllers\AffiliateAuth\EmailVerificationNotificationController;
use App\Http\Controllers\AffiliateAuth\EmailVerificationPromptController;
use App\Http\Controllers\AffiliateAuth\NewPasswordController;
use App\Http\Controllers\AffiliateAuth\PasswordController;
use App\Http\Controllers\AffiliateAuth\PasswordResetLinkController;
use App\Http\Controllers\AffiliateAuth\RegisteredUserController;
use App\Http\Controllers\AffiliateAuth\VerifyEmailController;
use Illuminate\Support\Facades\Route;

Route::middleware('guest:affiliate')->group(function () {
    Route::get('affiliate/register', [RegisteredUserController::class, 'create'])
                ->name('affiliate.register');

    Route::post('affiliate/register', [RegisteredUserController::class, 'store']);

    Route::get('affiliate/login', [AuthenticatedSessionController::class, 'create'])
                ->name('affiliate.login');

    Route::post('affiliate/login', [AuthenticatedSessionController::class, 'store']);

    Route::get('affiliate/forgot-password', [PasswordResetLinkController::class, 'create'])
                ->name('affiliate.password.request');

    Route::post('affiliate/forgot-password', [PasswordResetLinkController::class, 'store'])
                ->name('affiliate.password.email');

    Route::get('affiliate/reset-password/{token}', [NewPasswordController::class, 'create'])
                ->name('admin.password.reset');

    Route::post('affiliate/reset-password', [NewPasswordController::class, 'store'])
                ->name('affiliate.password.store');
});

Route::middleware('auth:affiliate')->group(function () {
    Route::get('affiliate/verify-email', EmailVerificationPromptController::class)
                ->name('affiliate.verification.notice');

    Route::get('affiliate/verify-email/{id}/{hash}', VerifyEmailController::class)
                ->middleware(['signed', 'throttle:6,1'])
                ->name('affiliate.verification.verify');

    Route::post('affiliate/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
                ->middleware('throttle:6,1')
                ->name('affiliate.verification.send');

    Route::get('affiliate/confirm-password', [ConfirmablePasswordController::class, 'show'])
                ->name('password.confirm');

    Route::post('affiliate/confirm-password', [ConfirmablePasswordController::class, 'store']);

    Route::put('affiliate/password', [PasswordController::class, 'update'])->name('password.update');

    Route::post('affiliate/logout', [AuthenticatedSessionController::class, 'destroy'])
                ->name('affiliate.logout');
});
