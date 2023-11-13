<div>
     <h2>Add New Product</h2>
 </div>
 <div>
     <a href="{{ route('products.index') }}"> Back</a>
 </div>
 
 <form action="{{ route('products.store') }}" method="POST">
     @csrf
 
     <div>
         <strong>Name:</strong> 
         <input type="text" name="name" placeholder="Name">  
     </div>
     <div>
         <strong>Description:</strong>
         <textarea style="height:150px" name="description" placeholder="Description"></textarea>
     </div>
     <div>
         <strong>Price:</strong>
         <input type="number" name="price" placeholder="Price">
     </div>
     <div>
         <strong>Category:</strong>
         <select name="category_id"> 
         @foreach ($categories as $category)
         <option value="{{ $category->id }}">{{ $category->name }}</option> 
         @endforeach
         </select>
     </div>
     <div>
         <button type="submit">Submit</button> 
     </div>
 
 </form>

<!-- CSRFとはWebアプリに外部からのリクエストを受け付けてしまい攻撃されるもの　その対策として書いている-->
<!-- optionタグ　selectタブ内で使用し、メニューの選択肢を作成する -->
<!-- select セレクトボックス作成 -->
<!-- textarea 複数行の入力が可能な入力欄を作成するためのタグ-->
<!-- submit フォームを送信するためのボタン-->
<!-- strong 分の一部に重要性を加える。太字になったりする-->
<!-- placeholderフォームの入力欄にあらかじめ記入されている薄い灰色のテキスト エラー--> 
