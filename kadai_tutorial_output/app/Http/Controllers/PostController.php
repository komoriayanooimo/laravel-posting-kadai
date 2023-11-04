<?php

// namespace（名前空間）クラスの住所　クラスがどの場所にあるのか明示している
// PostControllerクラスはApp\Http\Controllers;フォルダの中にあると言っている
namespace App\Http\Controllers;

// use宣言「このファイルではこのクラスを使います」と宣言すること
// このファイルではIlluminate\Httpフォルダの中にあるRequestクラスを使うよ
// 宣言しておくことで、そのファイル内ではRequestと記述するだけでRequestクラスが呼び出せる
use Illuminate\Http\Request;

// やりとりするモデルを宣言する　storeアクションではデータベース（postsテーブル）とやり取りするためのPostモデルを使うので、use宣言を行う
use App\Models\Post;

// Controllerというクラスを継承したPostControllerというクラス
class PostController extends Controller
{
    //　一覧ページ
    // viewヘルパー　ヘルパー（助っ人）Larevelにおいて好きな場所から便利に呼び出せる関数のこと。（ヘルパー関数）
    public function index() {
        // postsテーブルの全データを新しい順で取得する
        $posts = Post::latest()->get();
        // 変数$postをposts/index.blade.phpに渡す
        return view('posts.index', compact('posts')); // 表示したいビューを引数として指定する。resources/view/posts/index.blade.php →　view('posts.index')
    }

    // 作成ページ
    public function create() {
        return view('posts.create');
    }

    // 作成機能
    // storeアクションの役割　フォームで送信された情報は最終的にデータベースへ登録され、結果、WEB画面に反映される仕組み
    // どのテーブル・どの列（カラム）に登録されるかなどの割り当て指示はstoreアクションで行う
    public function store(Request $request) {
        // Postモデルをインスタンス化して新しいデータ（テーブルのレコード）を作成する　PostはModels/Post.php
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);

        $post = new Post();
        // フォームから送信された入力内容を各カラムに代入する　create_at、updated_atカラムには自動で値が挿入されるのでコードは不要
        // input()メソッドはllluminate\Http\Requestインスタンスのメソッドであり、全てのリクエストのHTTP動詞に対してユーザー入力値を取得できる
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        // saveメソッドでpostsテーブルにデータを保存する
        $post->save();

        // Laravelでリダイレクト（URL転送）させるにはredirect()ヘルパーを使う。routeメソッドを使う方法が見やすく、URLの変更にも影響を受けない
        // with()メソッド　投稿一覧ページにリダイレクトしたときにフラッシュメッセージ（処理の結果をユーザーに伝えるためのメッセージ）を表示させる
        return redirect()->route('posts.index')->with('flash_message', '投稿が完了しました。');
    }

    // 詳細ページ 受け取ったPostモデルのインスタンス（$post）をそのまま投稿詳細ページのビューに渡す
    public function show(Post $post) {
        // compact関数　引数に渡された変数とその値から配列を作成し、戻り値として返す関数
        return view('posts.show', compact('post'));
    }

    // 更新ページ
    public function edit(Post $post) {
        return view('posts.edit', compact('post'));
    }

    // 更新機能
    public function update(Request $request, Post $post) {
        $request->validate([
            'title' => 'required',
            'content' => 'required',
        ]);
        
        $post->title = $request->input('title');
        $post->content = $request->input('content');
        $post->save();

        return redirect()->route('posts.show', $post)->with('flash_message', '投稿を編集しました。');
    }

    // 削除機能
    public function destroy(Post $post) {
        $post->delete();

        return redirect()->route('posts.index')->with('flash_message', '投稿を削除しました。');
    }
}
