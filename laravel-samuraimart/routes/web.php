<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

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

Route::resource('products', ProductController::class); 
//リソースコントローラーという特殊なコントローラーを作成し、そのルートを登録するためのメソッド
// リソースコントローラーとはデータベースへのCRUD操作を行うために必要なメソッドが定義されているコントローラー
// Route::resource CRUD用のURLを一度に定義

