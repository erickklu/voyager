@extends('layouts.app')


@section('styles')
<style>
    .col-md-12 {
        border-top: 1px;
        color: solid #000000;
    }

    .col-md-12 hr {
        margin-top: 0;
    }

    .user-email {
        font-size: .85rem;
        padding-bottom: 0.7em;
    }

    .btn-custom {
        background-color: #6A8B41;
        color: white;
        /* border-radius: 0px; */
        border-bottom-left-radius: calc(0.375rem - (1px));
        border-bottom-right-radius: calc(0.375rem - (1px));
        border-top-left-radius: 0px;
        border-top-right-radius: 0px;
    }

    .btn-custom:hover {
        background-color: #4E6630;
        color: white;
    }

    .btn-custom:active {
        background-color: #4E6630;
        color: black;
    }

    .btn.edit {
        background-color: #6A8B41;
        color: white;
        margin-bottom: 1em;
    }

    .dropdown-toggle::after {
        margin-left: 0;
        
    }

</style>

@endsection

@section('content')


<div class="container-fluid p-0">
    <div class="container-fluid" style="background-color: white;">
        <div
            style="background-size:cover; background-image: url({{ Voyager::image(Voyager::setting('admin.bg_image'), voyager_asset('/images/bg.jpg')) }}); background-position: center center;position:absolute; top:0; left:0; width:100%; height:300px;">
        </div>
        <div style="height:160px; display:block; width:100%"></div>
        <div style="position:relative; z-index:9; text-align:center;">
            <img src="{{ Voyager::image($usuario->avatar) }}" class="avatar"
                style="border-radius:50%; width:150px; height:150px; border:5px solid #fff;"
                alt="{{ $usuario->name }} avatar">
            <h4>{{ $usuario->name }}</h4>
            <div class="user-email text-muted">{{ $usuario->email }}</div>
            @if (Auth::id() == $usuario->id)
                <a href="{{ route('usuarios.edit', $usuario->id) }}" class="btn edit">Editar</a>
            @endif
        </div>
    </div>

    <div class="col-md-12">
        <hr>
    </div>
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="row row-cols-1 row-cols-md-2 g-4">

                @foreach ($publicaciones as $publicacion)

                    <div class="col">
                        <div class="card h-100 p-0">
                            @if($publicacion->imagen)
                                <img src="{{ Voyager::image($publicacion->imagen) }}" class="card-img-top"
                                    alt="{{ $publicacion->titulo }}">
                            @endif
                            <div class="card-body">
                                @if (Auth::id() == $publicacion->author_id)
                                    <div class="dropdown float-end">
                                        <button class="btn btn-sm btn-light dropdown-toggle" type="button"
                                            id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                            
                                        </button>
                                        <ul class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                            <li><a class="dropdown-item"
                                                    href="{{ route('publicaciones.edit', $publicacion->id) }}">Editar</a></li>
                                            <li><a class="dropdown-item" href="#">
                                                    <form action="{{ route('publicaciones.destroy', $publicacion->id) }}"
                                                        method="POST" style="display:inline-block;">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button style="font-size: 17px" type="submit" class="btn btn-transparent p-0"
                                                            onclick="return confirm('¿Estás seguro de eliminar esta publicación?')">Eliminar</button>
                                                    </form>
                                                </a></li>
                                        </ul>
                                    </div>
                                @endif
                            <p class="card-text"><small class="text-body-secondary">Por
                                        {{ $publicacion->author->name }}</small>
                                </p>
                                

                                <h5 class="card-title">{{ ucwords($publicacion->titulo) }}</h5>
                                <p class="card-text">{!! $publicacion->descripcion !!}</p>
                                
                                <p class="card-text"><small
                                        class="text-body-secondary">{{ $publicacion->formatted_date }}</small>
                                </p>
                                @if ($publicacion->usuariosInteresados->count() > 0)
                                        @php
                                            $count = $publicacion->usuariosInteresados->count();
                                            $text = $count === 1 ? 'usuario interesado' : 'usuarios interesados';
                                        @endphp

                                        <button type="button" class="btn btn-light p-0" data-bs-toggle="modal"
                                            data-bs-target="#exampleModal">
                                            {{ $count }} {{ $text }}
                                        </button>

                                        <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog modal-sm">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h1 class="modal-title fs-5" id="exampleModalLabel">Usuarios interesados</h1>
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
                                <!-- @if (Auth::id() == $publicacion->author_id)
                                    <a href="{{ route('publicaciones.edit', $publicacion->id) }}"
                                        class="btn btn-warning">Editar</a>
                                    <form action="{{ route('publicaciones.destroy', $publicacion->id) }}" method="POST"
                                        style="display:inline-block;">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-danger"
                                            onclick="return confirm('¿Estás seguro de eliminar esta publicación?')">Eliminar</button>
                                    </form>
                                @endif -->
                            </div>
                            <div class="card-footer p-0">
                            <div class="btn-group w-100 text-center" role="group">
                        <form action="{{ route('publicaciones.intereses', ['id' => $publicacion->id]) }}" method="POST"
                            class="w-50">
                            @csrf
                            <div class="w-100">
                                <button type="submit" class="btn btn-light btn-block w-100">Me interesa</button>
                            </div>
                        </form>
                        <button type="button" class="btn btn-custom w-50">Comunicarte con el autor</button>
                    </div>
                            </div>
                        </div>
                    </div>

                @endforeach
            </div>
        </div>
    </div>


</div>
@endsection