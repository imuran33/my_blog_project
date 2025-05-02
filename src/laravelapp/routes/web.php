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

Route::get('/', 'UsersController@index');

// 一覧ページ（programming.blade.phpを表示）
Route::get('/programming', [App\Http\Controllers\ProgrammingController::class, 'index'])->name('programming.index');

// 記事詳細ページ（programming-detail.blade.phpを表示）
Route::get('/programming/{id}', [App\Http\Controllers\ProgrammingController::class, 'show'])->name('programming.show');