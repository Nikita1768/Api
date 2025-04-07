<?php

use App\Http\Controllers\Api\LoginController;
use App\Http\Controllers\Api\PlanController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\RegisterController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/** AUTH */
Route::post('register', [RegisterController::class, 'store']);
Route::post('login', [LoginController::class, 'store']);

/** GENERAL */
Route::get('plans/available', [PlanController::class, 'available']);
Route::get('posts', [PostController::class, 'getAll']);

/** USER PLANS */

Route::get('user/plans', [UserController::class, 'plans'])->middleware('auth:sanctum');
Route::post('user/plans/{plan}/buy', [PlanController::class, 'buy'])->middleware('auth:sanctum');

/** POSTS */
Route::get('user/posts', [UserController::class, 'posts'])->middleware('auth:sanctum');
Route::put('user/posts/{post}/activate', [PostController::class, 'activate'])->middleware('auth:sanctum');
Route::apiResource('user/posts', PostController::class)->middleware('auth:sanctum');

/** ADMIN PLANS */
Route::apiResource('admin/plans', PlanController::class)->middleware(['auth:sanctum', 'admin']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
