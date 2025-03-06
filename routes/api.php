<?php

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;


// Routes pour l'authentification
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth:sanctum');

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::middleware(['auth:sanctum'])->group(function () {
    Route::apiResource('tags', 'App\Http\Controllers\Api\TagController');
    Route::apiResource('categories', 'App\Http\Controllers\Api\CategorieController');
    Route::apiResource('comments', 'App\Http\Controllers\Api\CommentController');
    Route::apiResource('posts', 'App\Http\Controllers\Api\PostController');
});