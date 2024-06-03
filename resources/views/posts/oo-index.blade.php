@extends("layouts.app")

@push("css")
    <link rel="stylesheet" href="">


@endpush

@section('styles')
<style>
    .custom-row-width {
        max-width: 800px;
        /* Ajusta este valor según tus necesidades */
        margin: auto;
        /* Centra el contenido horizontalmente */
    }

    .btn-custom {
        background-color: #6A8B41;
        color: white;

    }

    .btn-custom:hover {
        background-color: #4E6630;
        color: white;
    }

    .btn-custom:active {
        background-color: #4E6630;
        color: white; /* Asegúrate de que el color sea blanco cuando el botón esté activo */
    }
    .active-category {
        background-color: #4E6630;
        color: white; /* Color blanco para texto activo */
    }

    /* .card-img-top {
        object-fit: cover;
        width: 500px;
        height: 500px;
    } */
</style>
@endsection

@section("title")
Publicaciones
@endsection

@section("content")
<div class="container-fluid" style="margin-top:30px">
    <div class="custom-row-width container-sm">
        <div class="row mb-3">
            @foreach($categorias as $categoria)
                <div class="col">
                    <a href="{{ route('publicaciones.categoria', $categoria->id) }}" class="btn btn-custom {{ isset($categoryId) && $categoryId == $categoria->id ? 'active' : '' }}">
                        {{ $categoria->name }}
                    </a>
                </div>
            @endforeach
        </div>
        <div class="row row-cols-1 row-cols-md-1 g-4">
            <button type="button" class="btn btn-custom" data-bs-toggle="modal" data-bs-target="#exampleModal">Crear
                Publicación</button>

            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Crear publicación</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <form action="{{ route('publicaciones.store') }}" method="POST"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="titulo">Título</label>
                                    <input type="text" name="titulo" class="form-control" required>
                                </div>
                                <div class="mb-3">
                                    <label for="descripcion">Descripción</label>
                                    <textarea name="descripcion" class="form-control" required></textarea>
                                </div>
                                <div class="mb-3">
                                    <label for="categoria">Categoría</label>
                                    <select name="categoria" id="categoria" class="form-control" required>
                                        @foreach($categorias as $categoria)
                                            <option value="{{ $categoria->id }}">{{ $categoria->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="imagen">Imagen</label>
                                    <input type="file" name="imagen" class="form-control" required>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-light" data-bs-dismiss="modal">Cerrar</button>
                                    <button type="submit" class="btn btn-custom">Guardar</button>
                                </div>
                            </form>
                        </div>

                    </div>
                </div>
            </div>

            @foreach ($publicaciones as $publicacion)
                <div class="card mb-3 p-0">
                    <img src="{{ Voyager::image($publicacion->imagen) }}" class="card-img-top" alt="...">

                    <div class="card-body">
                        @if (Auth::id() == $publicacion->author_id)
                            <div class="dropdown float-end">
                                <button class="btn btn-sm btn-light dropdown-toggle" type="button" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                </button>
                                <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                    <li><a class="dropdown-item"
                                            href="{{ route('publicaciones.edit', $publicacion->id) }}">Editar</a></li>
                                    <li><a class="dropdown-item" href="#">
                                            <form action="{{ route('publicaciones.destroy', $publicacion->id) }}" method="POST"
                                                style="display:inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button style="font-size: 17px" type="submit" class="btn btn-transparent p-0"
                                                    onclick="return confirm('¿Estás seguro de eliminar esta publicación?')">Eliminar</button>
                                            </form>
                                        </a></li>
                                </ul>
                            </div>
                        @endif

                        <p class="card-text">Por <a class="text-decoration-none" href="{{ route('usuarios.show', ['id' => $publicacion->author_id]) }}">{{ $publicacion->author->name }}</a></p>
                        <h5 class="card-title">{{ ucwords($publicacion->titulo) }}</h5>
                        <p class="card-text">{!! $publicacion->descripcion !!}</p>

                        <p class="card-text">
                            <small class="text-body-secondary">
                                {{ $publicacion->formatted_date }}
                            </small>
                        </p>
                        @if ($publicacion->usuariosInteresados->count() > 0)
                                        @php
                                            $count = $publicacion->usuariosInteresados->count();
                                            $text = $count === 1 ? 'usuario interesado' : 'usuarios interesados';
                                        @endphp

                                        <button type="button" class="btn btn-light p-0" data-bs-toggle="modal"
                                            data-bs-target="#modalInt">
                                            {{ $count }} {{ $text }}
                                        </button>

                                        <div class="modal fade" id="modalInt" tabindex="-1" aria-labelledby="modalIntLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="modalIntLabel">Usuarios interesados</h1>
                                                        <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                            aria-label="Close"></button>
                                                    </div>
                                                    <div class="modal-body">
                                                        <ul class="list-group list-group-flush">
                                                            @foreach($publicacion->usuariosInteresados as $usuario)
                                                                <li class="list-group-item"><a class="btn btn-light p-0" href="{{ route('usuarios.show', ['id' => $usuario->id]) }}">{{ $usuario->name }}</a></li>
                                                            @endforeach
                                                        </ul>

                                                    </div>
                                                    <!-- <div class="modal-footer">
                                                                                <button type="button" class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">Close</button>
                                                                            </div> -->
                                                </div>
                                            </div>
                                        </div>
                    @endif

                    </div>
                    <div class="card-footer p-0">
                        <div class="btn-group w-100" role="group">
                            <form action="{{ route('publicaciones.intereses', ['id' => $publicacion->id]) }}" method="POST"
                                class="w-50">
                                @csrf
                                <div class="w-100">
                                    <button type="submit" class="btn btn-light btn-block w-100">Me interesa</button>
                                </div>
                            </form>
                            <a href="{{ route('publicaciones.show', $publicacion->id) }}"
                                class="btn btn-custom w-50">Intercambiar</a>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</div>


@endsection

@push("js")

    <script>
        console.log("Hoala jabascritp")
    </script>

@endpush