<a href="{{ route('products.create') }}"> Create New Product</a> 

 <table>
     <tr>
         <th>Name</th>
         <th>Description</th>
         <th>Price</th>
         <th>Category ID</th>
         <th >Action</th>
     </tr>
     @foreach ($products as $product)
     <tr>
         <td>{{ $product->name }}</td>
         <td>{{ $product->description }}</td>
         <td>{{ $product->price }}</td>
         <td>{{ $product->category_id }}</td>
         <td>
            <form action="{{ route('products.destroy',$product->id) }}" method="POST"> 
             <a href="{{ route('products.show',$product->id) }}">Show</a>
             <a href="{{ route('products.edit',$product->id) }}">Edit</a>
             @csrf
             @method('DELETE')
             <button type="submit">Delete</button>
            </form>
         </td>
     </tr>
     @endforeach
 </table>

<!-- routeヘルパーを使うことで、リンク先のURLを自動的に作成 route('products.create')と記述すれば、/products/createへのリンクを作成--> 
<!-- BladeではPHPのコードを{{と}}で囲むことで変数の中身をそのまま表示できる -->
<!-- @foreach〜@endforeachの繰り返し処理を行うことで、短いコードで複数の商品を表示することが可能 -->

<!-- <form>タグを使って、削除リクエストを送信するフォームを作成 -->
<!-- /products/:idにDELETEリクエストを送ることでデータを削除できる -->
<!-- action="{{ route('products.destroy',$product->id) }}"でリクエストの送信先を指定--> 