@extends('layouts.app')


@section('content')
@foreach ($categorias as $categoria)

<p>{{$categoria->name}}</p>
@endforeach
@endsection