<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgrammingController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\DiaryController;

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

// 一覧ページ
Route::prefix('/')->group(function () {
    Route::get('programming', [ProgrammingController::class, 'index'])->name('programming.index');
    Route::get('music', [MusicController::class, 'index'])->name('music.index');
    Route::get('food', [FoodController::class, 'index'])->name('food.index');
    Route::get('diary', [DiaryController::class, 'index'])->name('diary.index');
});

// 記事詳細ページ
Route::get('programming/{id}', [ProgrammingController::class, 'show'])->name('programming.show');
Route::get('music/{id}', [MusicController::class, 'show'])->name('music.show');
Route::get('food/{id}', [FoodController::class, 'show'])->name('food.show');
Route::get('diary/{id}', [DiaryController::class, 'show'])->name('diary.show');

// ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');