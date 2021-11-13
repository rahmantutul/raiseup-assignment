<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserType;
use Illuminate\Http\Request;
/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('job')->group(function () {
    // Route::get('index/{id?}', [JobController::class, 'index']);
    // Route::post('add', [JobController::class, 'add']);
    // Route::put('edit/{id}', [JobController::class, 'edit']);
    // Route::delete('delete/{id}', [JobController::class, 'delete']);
    // Route::post('update-status/{id}', [JobController::class, 'updateStatus']);
});
Route::prefix('admin')->group(function () {
    // Route::get('index/{id?}', [AdminController::class, 'index']);
    // Route::post('add', [AdminController::class, 'add']);
    // Route::post('login', [AdminController::class, 'login']);
    Route::post('edit/{id}', [AdminController::class, 'edit']);
    Route::delete('delete/{id?}', [AdminController::class, 'delete']);
    Route::patch('update-status/{id}', [AdminController::class, 'updateStatus']);
});
