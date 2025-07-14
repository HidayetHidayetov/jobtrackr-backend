<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\AuthController;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('v1')->group(function () {
    Route::controller(AuthController::class)->prefix('auth')->group(function () {
        Route::post('register', 'register');
        Route::post('login', 'login');
        Route::middleware('auth:sanctum')->post('logout', 'logout');
    });

    Route::post('forgot-password', \App\Http\Controllers\Api\V1\ForgotPasswordController::class . '@sendResetLinkEmail');
    Route::post('reset-password', \App\Http\Controllers\Api\V1\ResetPasswordController::class . '@reset');

    Route::middleware('auth:sanctum')->apiResource('applications', \App\Http\Controllers\Api\V1\ApplicationController::class)->only([
        'index', 'store', 'show', 'update', 'destroy'
    ]);

    Route::middleware('auth:sanctum')->get('stats', \App\Http\Controllers\Api\V1\StatsController::class . '@index');
});
