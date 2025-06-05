<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CampusLocationController;
use App\Http\Controllers\FacilityCategoryController;
use App\Http\Controllers\DamageReportController;
use App\Http\Controllers\OfficerResponseController;
use App\Http\Controllers\UserManagementController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Ini adalah route web aplikasi Anda. Route dibagi menjadi dua bagian utama:
| 1. Route publik (login, register, welcome)
| 2. Route privat (dashboard & resource) yang dilindungi oleh middleware auth
|
*/

// ====================
// 📂 Public Routes
// ====================

Route::get('/', function () {
    return view('welcome');
});

// Login
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Register
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Kategori Fasilitas
Route::resource('facility_categories', FacilityCategoryController::class);

// ====================
// 🔐 Protected Routes (Hanya untuk user yang sudah login)
// ====================

Route::middleware('auth')->group(function () {

    // Dashboard
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    // Resource CRUD
    Route::resource('campus_locations', CampusLocationController::class);
    Route::resource('facility_categories', FacilityCategoryController::class);
    Route::resource('damage_reports', DamageReportController::class);
    Route::resource('officer_responses', OfficerResponseController::class);
    Route::resource('users', UserManagementController::class);

});
