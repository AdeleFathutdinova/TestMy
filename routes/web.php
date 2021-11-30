<?php

use Illuminate\Support\Facades\Route;

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


Auth::routes();

Route::get('/', 'App\Http\Controllers\HomeController@home')->name('home');
Route::get('/show/results/{result_id}', [App\Http\Controllers\HomeController::class, 'result'])->name('result');

//Admin
Route::middleware (['role:admin'])->prefix('admin')->group(function () {
    Route::get('/create', [App\Http\Controllers\AdminController::class, 'create'])->name('create');  //  /admin/create
    Route::post('/create/test', [App\Http\Controllers\AdminController::class, 'createTest'])->name('createTest');
    Route::post('/create/test/{id}', [App\Http\Controllers\AdminController::class, 'addQuestion'])->name('addQuestion');
    Route::get('/statistic', [App\Http\Controllers\AdminController::class, 'statistic'])->name('statistic');
});

//User
Route::middleware (['role:student'])->prefix('student')->group(function () {
    Route::get('/show', [App\Http\Controllers\UserController::class, 'showTests'])->name('showTests');  //  /user/show
    Route::get('/show/{test_id}', [App\Http\Controllers\UserController::class, 'startTest'])->name('startTest');
    Route::post('/show/results', [App\Http\Controllers\UserController::class, 'allResults'])->name('allResults');
    Route::get('/show/results/my{id}', [App\Http\Controllers\UserController::class, 'myResults'])->name('myResults');
});

