<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\CustomerRegisterController;
use App\Http\Controllers\Auth\AdminRegisterController;
use App\Http\Controllers\Auth\AdminLoginController;

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
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

// Customer Registration Routes
Route::get('/register/customer', [CustomerRegisterController::class, 'showRegistrationForm']);
Route::post('/register/customer', [CustomerRegisterController::class, 'register'])->name('customer.register');

// Admin Registration Routes
Route::get('/register/admin', [AdminRegisterController::class, 'showRegistrationForm']);
Route::post('/register/admin', [AdminRegisterController::class, 'register'])->name('admin.register');

// Admin Login Routes
Route::get('/login/admin', [AdminLoginController::class, 'showLoginForm']);
Route::post('/login/admin', [AdminLoginController::class, 'login'])->name('admin.login');

require __DIR__.'/auth.php';
