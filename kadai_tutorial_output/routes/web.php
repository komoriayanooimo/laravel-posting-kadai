<?php

use Illuminate\Support\Facades\Route;
// ルーティングを設定するコントローラーを宣言する
use App\Http\Controllers\PostController;

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

Route::get('/', [PostController::class, 'index']);

/*
// 投稿の一覧ページ nameメソッドを使って、そのルート（経路）に名前をつける
// Postコントローラーのindexアクションであれば以下のように
// getはHTTPリクエストメソッド　get=今ぺージの情報をください
Route::get('/posts', [PostController::class, 'index'])->name('posts.index');

// 投稿の作成ページ get 「このページの情報をください」
Route::get('/posts/create', [PostController::class, 'create'])->name('posts.create');

// 投稿の作成機能　post 「このデータを送るので受け取ってください」
Route::post('/posts', [PostController::class, 'store'])->name('posts.store');

// 投稿の詳細ページ
// {post}の部分に入るidはどのように判定するのかというと、route()ヘルパーの第2引数にPostモデルのインスタンスを指定する
// '/posts/{post}'のようにモデル名（小文字、単数形）を波括弧{}で囲むことで、このようにモデルのインスタンスを受け取れるようになる
// 受け取ったインスタンスのidを自動的に取得し、{post}の部分に入れてくれる
Route::get('/posts/{post}', [PostController::class, 'show'])->name('posts.show');

// 投稿の更新ページ
Route::get('/posts/{post}/edit', [PostController::class, 'edit'])->name('posts.edit');

// 投稿の更新機能 patch部分的な更新　put全体的な更新
Route::patch('/posts/{post}', [PostController::class, 'update'])->name('posts.update');

// 投稿の削除機能
Route::delete('/posts/{post}', [PostController::class, 'destroy'])->name('posts.destroy');
*/

Route::resource('posts', PostController::class);

