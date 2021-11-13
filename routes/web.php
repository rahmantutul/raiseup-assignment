<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\JobController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckUserType;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::group(['prefix' => 'admin', 'as'=>'.admin'], function() {
    Route::match(['get', 'post'], '/', [AdminController::class, 'login']);

    // Only authenticate user routes 
    Route::middleware(['admin'])->group(function () {
        Route::get('dashboard', [AdminController::class, 'index']);
        Route::get('logout', [AdminController::class, 'logout']);
        // Prevent general user from these routes 
        Route::middleware([CheckUserType::class])->group(function(){
            Route::match(['get', 'post'], 'edit/{id}', [AdminController::class, 'setting']);
            Route::match(['get', 'post'], 'update-password', [AdminController::class, 'updatePassword']);
            Route::get('index', [AdminController::class, 'adminList']);
            Route::match(['get', 'post'], 'add', [AdminController::class, 'add']);
            Route::get('delete-admin/{id}', [AdminController::class, 'delete']);
            Route::post('/update-admin-status', [AdminController::class, 'updateAdminStatus']);
        });
        // Jobs routes 
         Route::prefix('job')->group(function () {
            Route::get('index', [JobController::class, 'index']);
            Route::get('single/{id}', [JobController::class, 'single']);
             // Prevent general user from these routes from url
             Route::middleware([CheckUserType::class])->group(function(){
             Route::match(['get', 'post'], 'add', [JobController::class, 'add']);
             Route::match(['get', 'post'], 'edit/{id}', [JobController::class, 'edit']);
             Route::get('delete/{id}', [JobController::class, 'delete']);
             Route::post('/update-job-status', [JobController::class, 'updateJobStatus']);
          });
               
        });
    });
});

