<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::post('/register', [AuthController::class, 'store']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::prefix('/users')->group(function () {
    Route::post('/edit/{id}', [UserController::class, 'update'])->middleware('auth:sanctum');
    Route::get('/profile', [UserController::class, 'profile'])->middleware('auth:sanctum');
});

Route::prefix('posts')->group(function () {
    Route::post('/store', [PostController::class, 'storePost']);
    Route::post('/edit/{id}', [PostController::class, 'updatePost']);
    Route::post('/delete/{id}', [PostController::class, 'destroy']);
    Route::get('/show-post/{slug}', [PostController::class, 'showPost']);
    Route::get('/show-posts', [PostController::class, 'showPosts']);
})->middleware('auth:sanctum');

Route::prefix('post-categories')->group(function () {
    Route::post('/store', [CategoryController::class, 'storeCategory']);
    Route::post('/edit/{id}', [CategoryController::class, 'updateCategory']);
    Route::post('/delete/{id}', [CategoryController::class, 'destroyCategory']);
    Route::get('/show-categories', [CategoryController::class, 'showCategories']);
})->middleware('auth:sanctum');