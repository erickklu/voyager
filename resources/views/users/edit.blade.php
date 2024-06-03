@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Publicación</h1>
    <form action="{{ route('usuarios.update', $usuarios) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="name">Nombre</label>
            <input type="text" name="name" class="form-control" value="{{ $usuarios->name }}" required>
        </div>
        <div class="form-group">
            <label for="email">Correo</label>
            <textarea name="email" class="form-control" required>{{ $usuarios->email }}</textarea>
        </div>
        <div class="form-group">
            <label for="avatar">Imagen</label>
            <input type="file" name="avatar" class="form-control">
            @if ($usuarios->avatar)
                <img src="{{ Voyager::image($usuarios->avatar) }}" alt="Imagen actual" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection
