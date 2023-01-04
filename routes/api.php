<?php

use Riyu\Router\Route;
use App\Controllers\Api\Absensi;
use App\Controllers\Api\Auth;
use App\Controllers\Api\ForgotPassword;
use App\Controllers\Api\Informasi;
use App\Controllers\Api\Jadwal;
use App\Controllers\Api\Mail;
use App\Controllers\Api\Settings;
use App\Models\Siswa;

Route::group('/api/v3/user', function () {
    Route::post('/login', [Auth::class, 'login']);
    Route::post('/new-login', [Auth::class, 'newLogin']);
    Route::post('/logout', [Auth::class, 'logout']);

    Route::post('/update-profile', [Settings::class, 'updateProfile']);
    Route::post('/change-password', [Settings::class, 'changePassword']);
    Route::post('/delete-foto', [Settings::class, 'deleteFoto']);

    Route::get('/search/{username}', [ForgotPassword::class, 'search']);
    Route::post('/verify-otp', [ForgotPassword::class, 'verifyOtp']);
    Route::post('/reset-password', [ForgotPassword::class, 'resetPassword']);
    Route::get('/otp', [ForgotPassword::class, 'verifyToken']);
});

Route::group('/api/v3/jadwal', function () {
    Route::get('/pelajaran/{id}', [Jadwal::class, 'pelajaran']);
    Route::get('/ujian/{id}', [Jadwal::class, 'ujian']);
    Route::get('/presensi/{id}', [Jadwal::class, 'presensi']);
});

Route::group('/api/v3/absensi', function () {
    Route::get('/log/{id}', [Absensi::class, 'log']);
    Route::post('/presensi', [Absensi::class, 'presensi']);
});

Route::post('/api/v3/mail/send', [Mail::class, 'index']);
Route::get('/api/v3/informasi', [Informasi::class, 'index']);
Route::get('/user/auth', [ForgotPassword::class, 'toUrl']);