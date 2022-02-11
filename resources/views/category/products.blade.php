<html>
<body>
<h1>Hello, {{$category->name}}</h1>
<div class="">
    @foreach($products as $product)
    {{$product->id}}
    @endforeach
</div>
</body>
</html>
