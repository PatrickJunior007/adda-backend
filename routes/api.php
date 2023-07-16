<?php

use App\Http\Controllers\OperationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/posts', [OperationController::class, 'createPost']);
Route::post('/beats', [OperationController::class, 'createBeat']);
Route::post('/posts/{post}/like', [OperationController::class, 'createLikePost']);
Route::post('/beats/{beat}/like', [OperationController::class, 'createLikeBeat']);
