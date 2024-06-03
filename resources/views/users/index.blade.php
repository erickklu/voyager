@extends("layouts.app")

@push("css")
    <link rel="stylesheet" href="">
@endpush

@section('styles')
<style>
    .btn-custom {
        background-color: #6A8B41;
        color: white;

    }

    .btn-custom a {
        background-color: #6A8B41;
        color: white;

    }

    .btn-custom:hover {
        background-color: #4E6630;
        color: white;
    }

    .btn-custom:active {
        background-color: #4E6630;
        color: black;
    }

    .card-img-top {
        object-fit: cover;
        height: 415px;
    }
</style>
@endsection
@section("title")
Usuarios
@endsection

@section("content")
<!-- <pre>{{ print_r($usuarios, true) }}</pre> -->
<div class="container-fluid" style="margin-top:30px">
    <div class="container-sm">
        <div class="row row-cols-1 row-cols-md-3 g-4">
            @foreach ($usuarios as $usuario)
                <div class="col">
                    <div class="card h-100">
                        <img src="{{ Voyager::image($usuario->avatar) }}" class="card-img-top" alt="...">
                        <div class="card-body">
                            <h5 class="card-title">{{ $usuario->name }}</h5>
                            <p class="card-text">{{ $usuario->email }}</p>
                            <div class="d-grid gap-2">
                                
                                <a class="btn btn-custom" type="button" href="{{ route('usuarios.show', $usuario->id) }}">Ver Perfil</a>
                                        
                            </div>
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