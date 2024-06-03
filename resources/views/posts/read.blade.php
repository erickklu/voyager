@extends('layouts.app')

@section('styles')
<style>
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
   

    .dropdown-toggle::after {
        margin-left: 0;

    }
</style>

@endsection

@section('content')
<div class="container" style="margin-top: 30px;">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card mb-3">
                @if($publicacion->imagen)
                    <img src="{{ Voyager::image($publicacion->imagen) }}" class="card-img-top"
                        alt="{{ $publicacion->titulo }}">
                @endif
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
                <!-- <p class="card-text"><small class="text-body-secondary">Por {{ $publicacion->author->name }}</small> -->
                <p class="card-text">Por <a class="text-decoration-none" href="{{ route('usuarios.show', ['id' => $publicacion->author_id]) }}">{{ $publicacion->author->name }}</a></p>
                </p>
                    
                    <h5 class="card-title">{{ ucwords($publicacion->titulo) }}</h5>
                    <p class="card-text">{!! $publicacion->descripcion !!}</p>
                    
                    <p class="card-text"><small class="text-body-secondary">{{ $publicacion->formatted_date }}</small>
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
                    @else
                        <p>Nadie ha mostrado interés en esta publicación aún.</p>
                    @endif




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
    </div>
</div>
@endsection