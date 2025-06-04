<?php

use App\Http\Controllers\DashBoardController;
use App\Http\Controllers\ProductOrderController;
use App\Http\Controllers\VarianceReportController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StoresOutletsController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\TransactionTypeController;
use App\Http\Controllers\TransactionController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\AuthController;

//Authentication routes
Route::post('login', [AuthController::class, 'login']);
Route::post('logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');
Route::post('/checkAuth', [AuthController::class, 'checkAuth'])->middleware('auth:sanctum');

// User Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('users', [UserController::class, 'index']);
    Route::get('users/profile', [UserController::class, 'me']);
    Route::post('users', [UserController::class, 'store']);
    Route::get('users/{id}', [UserController::class, 'show']);
    Route::patch('users/{id}', [UserController::class, 'update']);
    Route::delete('users/{id}', [UserController::class, 'destroy']);
});

// Stores and Outlets Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/stores', [StoresOutletsController::class, 'index']);
    Route::post('/stores', [StoresOutletsController::class, 'store']);
    Route::get('/stores/{id}', [StoresOutletsController::class, 'show']);
    Route::patch('/stores/{id}', [StoresOutletsController::class, 'update']);
    Route::delete('/stores/{id}', [StoresOutletsController::class, 'destroy']);
});

// Category Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/categories', [CategoryController::class, 'index']);
    Route::get('/categoryCount', [CategoryController::class, 'countCategory']);
    Route::post('/categories', [CategoryController::class, 'store']);
    Route::get('/categories/{id}', [CategoryController::class, 'show']);
    Route::patch('/categories/{id}', [CategoryController::class, 'update']);
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy']);
});

// Transaction Type Routes
Route::get('/transaction_types', [TransactionTypeController::class, 'index']);
Route::get('/transaction_types/{id}', [TransactionTypeController::class, 'show']);

// Transaction Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/transactions', [TransactionController::class, 'index']);
    Route::post('/transactions', [TransactionController::class, 'store']);
    Route::get('/transactions/{id}', [TransactionController::class, 'show']);
    Route::delete('/transactions/{id}', [TransactionController::class, 'destroy']);
});


// Product Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/products', [ProductController::class, 'index']);
    Route::post('/products', [ProductController::class, 'store']);
    Route::get('/products/{id}', [ProductController::class, 'show']);
    Route::patch('/products/{id}', [ProductController::class, 'update']);
    Route::delete('/products/{id}', [ProductController::class, 'destroy']);
    Route::get('search/products/{search}', [ProductController::class, 'searchProduct']);
});

// Product Order Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/productOrders', [ProductOrderController::class, 'index']);
    Route::post('/productOrders', [ProductOrderController::class, 'store']);
    Route::get('/productOrders/{id}', [ProductOrderController::class, 'show']);
    Route::patch('/productOrders/{id}', [ProductOrderController::class, 'update']);
    Route::delete('/productOrders/{id}', [ProductOrderController::class, 'destroy']);
});

//Variance Report Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/varianceReport', [VarianceReportController::class, 'index']);
    Route::get('/varianceReport/{id}', [VarianceReportController::class, 'show']);
    Route::post('/varianceReport', [VarianceReportController::class, 'store']);
});


// Dashboard Routes
Route::middleware('auth:sanctum')->group(function () {
    Route::get('/dashboard/topProducts', [DashBoardController::class, 'getTopFour']);
    Route::get('/dashboard/monthlyReport', [DashBoardController::class, 'getMonthlyReport']);
    Route::get('/dashboard/totalStock', [DashBoardController::class, 'getAllStocks']);
    Route::get('/dashboard/lowStock', [DashBoardController::class, 'getAllLowStock']);
    Route::get('/dashboard/outOfStock', [DashBoardController::class, 'getAllOutOfStock']);

});