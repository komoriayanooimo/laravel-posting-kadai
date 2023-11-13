<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Http\Controllers\Category; //カテゴリを取り扱うCategoryモデルをProductController.php内で使用することができる
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all(); //Productモデルを使ってすべての商品データをデータベースから取得。取得したデータを変数$productsに代入。
        
        return view('products.index', compact('products')); 
        /**
         * products.indexとはresources\views\productsディレクトリの中にあるindex.blade.php
         * cpmpact関数　compact('products')と記述すると、変数$productsがビューに渡される
         */
    }

    /**
     * 
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        // $categoriesにすべてのカテゴリを保存し、ビューへと渡す
        return view('products.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $product = new Product(); //Productモデルの変数を$product = new Product();にて作成
        // フォームから送信されたデータが格納されている$request変数の中から、nameとdescriptionなどの項目のデータをそれぞれのカラムに保存
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->save(); // 最後に$product->save()で、データベースへと保存

        return to_route('products.index'); //はデータが保存された後、リダイレクト（別のページに移動すること)を行う。to_route()関数は別のページに移動するために行う
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
        // view()関数はビューファイルを表示するため
        // resources\views\productsディレクトリ内のshow.blade.phpをビューとして使用
        // compact('product')で商品のデータが保存されている変数を、ビューへ渡す
        //showアクションに対応したURLは/products/:idというURLになります。この:idの部分の値を元に、Laravel側が自動的にデータベースから該当するIDのデータを$productに渡す
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function edit(Product $product)
    {
        $categories = Category::all();

        return view('products.edit', compact('product', 'categories'));
        //editアクションのURLは/products/:id/editとなっており、showアクションと同じくLaravel側で自動的に該当するデータを取得
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    // 更新前の商品のデータは$product変数に渡されています。それを元に、$request内に格納されているフォームに入力した更新後のデータをそれぞれのカラムに渡して上書きしている
    {
        $product->name = $request->input('name');
        $product->description = $request->input('description');
        $product->price = $request->input('price');
        $product->category_id = $request->input('category_id');
        $product->update();  //updateアクションでは$product->update()を実行することでデータベースに保存（更新）

        return to_route('products.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete(); //データベースから指定の商品のデータを削除しています
        
        return to_route('products.index'); //productsというURLへとリダイレクトしている
    }
}
