<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CampusLocationController;
use App\Http\Controllers\FacilityCategoryController;
use App\Http\Controllers\DamageReportController;
use App\Http\Controllers\OfficerResponseController;
use App\Http\Controllers\UserManagementController;
use App\Http\Controllers\DashboardController;

// ====================
// 📂 Public Routes
// ====================

Route::get('/', fn () => view('welcome'));

Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// ====================
// 🔐 Common for All Logged In Users
// ====================
Route::middleware('auth')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
});

// ====================
// 🛡️ Admin Only Routes
// ====================
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::resource('users', UserManagementController::class);
    Route::resource('campus_locations', CampusLocationController::class);
    Route::resource('facility_categories', FacilityCategoryController::class);
    Route::resource('officer_responses', OfficerResponseController::class);
    Route::resource('damage_reports', DamageReportController::class);
    Route::get('/laporan', fn () => view('laporan.index'))->name('laporan.index');
    Route::get('/lokasi', fn () => view('lokasi.index'))->name('lokasi.index');
});

// ====================
// 👷 Petugas Only Routes (tapi admin juga boleh akses)
// ====================
Route::middleware(['auth', 'role:admin,petugas'])->group(function () {
    Route::resource('officer_responses', OfficerResponseController::class);
});

// ====================
// 🎓 Mahasiswa Only Routes (tapi admin juga boleh akses)
// ====================
Route::middleware(['auth', 'role:admin,mahasiswa'])->group(function () {
    Route::resource('damage_reports', DamageReportController::class);
    Route::get('hasil_report', [DamageReportController::class, 'progress'])->name('damage_reports.progress');
});
