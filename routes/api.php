<?php

use App\Http\Controllers\AppUtilsController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\PasswordController;
use App\Http\Controllers\Auth\SignupController;
use App\Http\Controllers\Auth\VerificationController;
use App\Http\Controllers\Billings\GiveawayController;
use App\Http\Controllers\Billings\VTU\AirtimeDataController;
use App\Http\Controllers\Transactions\TransactionController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\WebhookController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::post("register", [SignupController::class, "signupWithEmail"])->name("register");
Route::post("verify-account", [VerificationController::class, "verifyAccount"]);
Route::get("resend-verification", [VerificationController::class, "resendVerificationCode"])->middleware("throttle:1,1");
Route::post("forgot-password", [PasswordController::class, "forgotPassword"]);
Route::post("reset-password", [PasswordController::class, "resetPassword"]);
Route::post("login", [LoginController::class, "loginWithEmail"])->middleware("throttle:3,1");

Route::middleware("auth:sanctum")->group(function(){
    Route::prefix("user")->group(function(){
        Route::get("", [UserController::class, "getUserDetails"]);
        Route::post("change-profile-photo", [UserController::class, "changeProfilePhoto"]);
        Route::post("change-pin", [UserController::class, "changePin"]);
        Route::post("change-password", [UserController::class, "changePassword"]);
        Route::post("change-tag", [UserController::class, "changeUserTag"]);
        Route::post("validate-pin", [UserController::class, "validatePin"]);
        Route::get("referrals", [UserController::class, "getReferrals"]);
        Route::post("reset-pin", [UserController::class, "resetPin"]);
        Route::post("update-daily-limit", [UserController::class, "updateDailyLimit"])->middleware("auth.pin");;
    });

    Route::prefix("transactions")->group(function(){
        Route::get("", [TransactionController::class, "getTransactions"]);
        Route::post("fund-wallet", [TransactionController::class, "initateFundWallet"]);
        Route::get("verify/{transaction}", [TransactionController::class, "verifyPaymentTransaction"]);
    });
});

Route::prefix("transactions")->name("utils.")->group(function(){
    Route::get("payment-methods", [AppUtilsController::class, "getPaymentMethods"]);
});