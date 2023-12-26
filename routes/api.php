<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookController;
use App\Http\Controllers\Api\BookmarkController;
use App\Http\Controllers\Api\DepartmentController;
use App\Http\Controllers\Api\BorrowedBookController;
use App\Http\Controllers\Api\BorrowController;

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

//Public APIs
Route::post('/login', [AuthController::class, 'login'])->name('user.login');
Route::post('/user', [UserController::class, 'store'])->name('user.store');

Route::controller(DepartmentController::class)->group(function () {
    Route::get('/department',             'index');
    Route::get('/department/{id}',        'show');
    Route::post('/department',            'store');
    Route::put('/department/{id}',        'update');
});

// User Selection
// Route::get('/user/selection', [UserController::class, 'selection']);

//Private APIs
Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);

    Route::controller(BookController::class)->group(function () {
        Route::get('/book',             'index');
        Route::get('/book/{id}',        'show');
        Route::post('/book',            'store');
        Route::put('/book/{id}',        'update');
        Route::delete('/book/{id}',     'destroy');
    });

    Route::controller(BorrowController::class)->group(function () {
        Route::get('/borrow',             'index');
        Route::get('/borrow/{id}',        'show');
        Route::post('/borrow',            'store');
        Route::put('/borrow',             'update');
        Route::delete('/borrow/{id}',     'destroy');
    });

    Route::controller(BookmarkController::class)->group(function () {
        Route::get('/bookmark',             'index');
        Route::get('/bookmark/{id}',        'show');
        Route::post('/bookmark',            'store');
        Route::delete('/bookmark/{id}',     'destroy');
    });

    Route::controller(BorrowedBookController::class)->group(function () {
        Route::get('/history',             'index');
        Route::get('/history/{id}',        'show');
        Route::delete('/history/{id}',     'destroy');
    });

    Route::controller(UserController::class)->group(function () {
        Route::get('/user',                             'index');
        Route::get('/user/{id}',                        'show');
        Route::put('/user/{id}',                        'update')->name('user.update');
        Route::put('/user/email/{id}',                  'email')->name('user.email');
        Route::put('/user/password/{id}',               'password')->name('user.password');
        Route::put('/user/profile_picture/{id}',        'profile_picture')->name('user.profile_picture');
        Route::delete('/user/{id}',                     'destroy');
    });
});