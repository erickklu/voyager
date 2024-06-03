@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Editar Publicación</h1>
    <form action="{{ route('publicaciones.update', $publicaciones) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="titulo">Título</label>
            <input type="text" name="titulo" class="form-control" value="{{ $publicaciones->titulo }}" required>
        </div>
        <div class="form-group">
            <label for="descripcion">Descripción</label>
            <textarea name="descripcion" class="form-control" required>{{ $publicaciones->descripcion }}</textarea>
        </div>
        <div class="mb-3">
            <label for="categoria">Categoría</label>
            <select name="categoria_id" class="form-control" required>
                @foreach($categorias as $categoria)
                    <option value="{{ $categoria->id }}" {{ $publicaciones->categoria_id == $categoria->id ? 'selected' : '' }}>
                        {{ $categoria->name }}
                    </option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="imagen">Imagen</label>
            <input type="file" name="imagen" class="form-control">
            @if ($publicaciones->imagen)
                <img src="{{ Voyager::image($publicaciones->imagen) }}" alt="Imagen actual" width="100">
            @endif
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
</div>
@endsection