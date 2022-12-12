<?php

use Riyu\Router\Route;
use App\Controllers\Api\Auth;
use App\Controllers\Api\ForgotPassword;
use App\Controllers\Api\Settings;


Route::group('/api/v3/user', function () {
    Route::post('/login', [Auth::class, 'login']);
    Route::post('/newlogin', [Auth::class, 'newLogin']);
    Route::post('/logout', [Auth::class, 'logout']);
    Route::post('/update-profile', [Settings::class, 'updateProfile']);
    Route::post('/change-password', [Settings::class, 'changePassword']);
    Route::post('/delete-foto', [Settings::class, 'deleteFoto']);
    Route::get('/search/{username}', [ForgotPassword::class, 'search']);
    Route::post('/verify-otp', [ForgotPassword::class, 'verifyOtp']);
    Route::post('/reset-password', [ForgotPassword::class, 'resetPassword']);
});

Route::group('/api/v3/jadwal', function () {
    Route::get('/pelajaran/{id}', []);
    Route::get('/ujian/{id}', []);
    Route::get('/presensi/{id}', []);
});

Route::group('/api/v3/absensi', function () {
    Route::get('/log/{id}', []);
    Route::post('/presensi', []);
});

Route::group('/api/v3/mail', function () {
    Route::post('/send', []);
});

Route::group('/api/v3', function () {
    Route::get('/informasi', []);
});
