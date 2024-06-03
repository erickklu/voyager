@extends('voyager::master')
@section('css')
<style>
    .user-email {
        font-size: .85rem;
        margin-bottom: 1.5em;
    }
</style>
@stop
@section('content')

<div
    style="background-size:cover; background-image: url({{ Voyager::image(Voyager::setting('admin.bg_image'), voyager_asset('/images/bg.jpg')) }}); background-position: center center;position:absolute; top:0; left:0; width:100%; height:300px;">
</div>
<div style="height:160px; display:block; width:100%"></div>
<div style="position:relative; z-index:9; text-align:center;">
    <img src="{{ Voyager::image($dataTypeContent->avatar) }}" class="avatar"
        style="border-radius:50%; width:150px; height:150px; border:5px solid #fff;"
        alt="{{ $dataTypeContent->name }} avatar">
    <h4>{{ ucwords($dataTypeContent->name) }}</h4>
    <div class="user-email text-muted">{{ ucwords($dataTypeContent->email) }}</div>
    @can('edit', $dataTypeContent)
        <a href="{{ route('voyager.' . $dataType->slug . '.edit', $dataTypeContent->getKey()) }}" class="btn btn-primary"
            style="margin-bottom:23px">
            <i class="glyphicon glyphicon-pencil"></i> <span class="hidden-xs hidden-sm"></span>
            <span class="hidden-xs hidden-sm">{{ __('voyager::generic.edit') }}</span>
        </a>
    @endcan

    <!-- <pre>{{ print_r($dataTypeContent, true) }}</pre> -->

    <!-- @foreach($publicaciones as $publicacion)
    @php
        // Convertir el objeto JSON en un objeto estándar de PHP
        $publicacionObjeto = json_decode(json_encode($publicacion));
    @endphp

    <h4>{{ $publicacionObjeto->titulo }}</h4>
    <p>{{ $publicacionObjeto->descripcion }}</p>
    <img src="{{ Voyager::image($publicacionObjeto->imagen) }}" alt="Imagen de la publicación" style="border-radius:50%; width:150px; height:150px; border:5px solid #fff;">
    <h1>-------------------------------------------------------------</h1>
@endforeach -->

    <!--  @foreach($userPublications as $publicacion)
        <h4>{{ $publicacion->titulo }}</h4>
        <p>{!! $publicacion->descripcion !!}</p>
        <img src="{{ Voyager::image($publicacion->imagen) }}" alt="Imagen de la publicación"
            style="width:150px; height:150px; border:5px solid #fff;">
        <h1>-------------------------------------------------------------</h1>
    @endforeach -->

    <!-- @foreach($dataType->readRows as $row)
        @if($row->type == 'relationship')
            <p>
                @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details])
            </p>
        @elseif(
                $row->type == 'select_dropdown' && property_exists($row->details, 'options') &&
                !empty($row->details->options->{$dataTypeContent->{$row->field} })
            )
            <?php echo $row->details->options->{$dataTypeContent->{$row->field} };?>
        @elseif($row->type == 'select_multiple')
            @if(property_exists($row->details, 'relationship'))

                @foreach(json_decode($dataTypeContent->{$row->field}) as $item)
                    {{ $item->{$row->field}  }}
                @endforeach

            @elseif(property_exists($row->details, 'options'))
                @if (!empty(json_decode($dataTypeContent->{$row->field})))
                    @foreach(json_decode($dataTypeContent->{$row->field}) as $item)
                        @if (@$row->details->options->{$item})
                            {{ $row->details->options->{$item} . (!$loop->last ? ', ' : '') }}
                        @endif
                    @endforeach
                @else
                    {{ __('voyager::generic.none') }}
                @endif
            @endif
        @endif
    @endforeach -->
    @foreach($userPublications as $publicacion)
        <div class="page-content read container-fluid">
            <div class="col-md-12" style="min-height: 300px; display: flex; align-items: center;">
                <div class="panel panel-bordered" style="padding:15px 0px 0px 0px; max-height: 100%; width:100%;">
                    <div class="page-content read container-fluid ">
                        <div class="col-md-12" style="max-height: 100%; display: flex; align-items: center;">
                            <div class="col-md-6">
                                <div class="panel panel-bordered"
                                    style="border-color:rgba(0, 0, 0, .1); border-radius:10px; max-height: 100%; min-height: 350px; border-width: 1px">
                                    <div
                                        style="position:relative; z-index:9; text-align:start; margin-left: 20px; margin-right: 20px; color:#000000E6;">
                                        <h1>{{ ucwords($publicacion->titulo) }}</h1>
                                        <p>{!! $publicacion->descripcion !!}</p>

                                        <a href="" class="btn btn-primary"
                                            style="margin-bottom:1px; margin-top:20px; width: 100%; height: 40px; justify-content:center;">
                                            <!-- <i class="glyphicon glyphicon-pencil"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.edit') }}</span> -->
                                            <span class="hidden-xs hidden-sm">Intercambiar objeto</span>
                                        </a>


                                        <h5 style="margin-bottom: 0px;">Publicado por</h5>
                                        <p>{{ $dataTypeContent->name }}</p>


                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 d-flex justify-content-center align-items-center"
                                style="max-height: 100%;">
                                <img src="{{ Voyager::image($publicacion->imagen) }}" class="avatar"
                                    style="max-width:70%; max-height:70%; padding:30px;" alt="avatar">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    @endforeach
</div>
@stop