<?php

use App\Http\Controllers\DashboardController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\OrderController;

// Dashboard & Detail
Route::get('/', [DashboardController::class, 'index'])->name('dashboard');
Route::get('/event/{id}', [DashboardController::class, 'show'])->name('event.show');

// Auth Routes
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');
Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// Order Routes
Route::post('/order', [OrderController::class, 'store'])->name('orders.store');
Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');