<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// Modelというクラスを継承したPostというクラス
class Post extends Model
{
    // HasFactory テスト用のデータ（ダミーデータ）を大量に作成するためのメソッドを提供するトレイト
    // トレイト　いくつかのメソッドをまとめたもの
    use HasFactory;
}
