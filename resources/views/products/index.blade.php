@extends("layouts.app")

@push("css")
    <link rel="stylesheet" href="">
@endpush

@section("title")
    Productos
@endsection

@section("content")
   <h1>Vista de productos</h1>

   @foreach ($productos as $producto)
    <div>
        <h2>{{ $producto->name }}</h2>
        <p>{!! $producto->body!!}</p>
    </div>

    
@endforeach
@endsection

@push("js")

<script>
    console.log("Hoala jabascritp")
    </script>

@endpush






