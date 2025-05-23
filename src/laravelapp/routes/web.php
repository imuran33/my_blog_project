<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProgrammingController;
use App\Http\Controllers\UsersController;
use App\Http\Controllers\MusicController;
use App\Http\Controllers\FoodController;
use App\Http\Controllers\DiaryController;
use App\Http\Controllers\PostController;
use App\Http\Controllers\TagController;
use App\Http\Controllers\Auth\WithdrawController;

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

Route::get('/', 'UsersController@index')->name('welcome');
//いいね表示
Route::get('favorites', 'UsersController@favorites')->name('user.favorites');

// ユーザ新規登録
Route::get('signup', 'Auth\RegisterController@showRegistrationForm')->name('signup');
Route::post('signup', 'Auth\RegisterController@register')->name('signup.post');

// ログイン
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login')->name('login.post');
Route::post('logout', 'Auth\LoginController@logout')->name('logout');

// ログイン後
Route::group(['middleware' => 'auth'], function () {
    // いいね実行・削除
    Route::group(['prefix' => 'posts/{id}'], function () {
        Route::post('favorite', 'FavoriteController@store')->name('favorite');
        Route::delete('unfavorite', 'FavoriteController@destroy')->name('unfavorite');
    });

    //マイページ閲覧と、プロフィール編集
    Route::get('mypage', [UsersController::class, 'showMyPage'])->name('showMyPage');
    Route::get('/profile/edit', 'UsersController@edit')->name('profile.edit');
    Route::post('/profile/update', 'UsersController@update')->name('profile.update');
});

//退会
Route::delete('withdrawal', 'Auth\WithdrawController@destroy')
    ->middleware('auth')
    ->name('withdrawal');

//記事作成コマンド
Route::get('create', 'PostController@create')->name('create.post');
Route::post('create', 'PostController@store')->name('store.post');

//画像保存用メソッド
Route::post('/attachments', 'AttachmentController@store')->name('attachments.store');

// 投稿編集コマンド
Route::get('/post/{id}/edit', 'PostController@edit')->name('edit.post');
Route::post('/post/{id}/update', 'PostController@update')->name('update.post');

//検索機能
Route::get('/tag/{name}', [TagController::class, 'showPostsByTag'])->name('tag.posts');
Route::get('/search', [PostController::class, 'search'])->name('post.search');

// 一覧ページ
Route::get('{category}', [PostController::class, 'index'])->name('category.index');

// 記事詳細ページ
Route::get('{category}/{id}', [PostController::class, 'show'])->name('category.show');
