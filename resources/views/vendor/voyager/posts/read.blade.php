@extends('voyager::master')

@section('page_title', __('voyager::generic.view') . ' ' . $dataType->getTranslatedAttribute('display_name_singular'))

@section('page_header')
<h1 class="page-title">

    <i class="{{ $dataType->icon }}"></i> {{ __('voyager::generic.viewing') }}
    {{ ucfirst($dataType->getTranslatedAttribute('display_name_singular')) }} &nbsp;

    @can('edit', $dataTypeContent)
        <a href="{{ route('voyager.' . $dataType->slug . '.edit', $dataTypeContent->getKey()) }}" class="btn btn-info">
            <i class="glyphicon glyphicon-pencil"></i> <span
                class="hidden-xs hidden-sm">{{ __('voyager::generic.edit') }}</span>
        </a>
    @endcan
    @can('delete', $dataTypeContent)
        @if($isSoftDeleted)
            <a href="{{ route('voyager.' . $dataType->slug . '.restore', $dataTypeContent->getKey()) }}"
                title="{{ __('voyager::generic.restore') }}" class="btn btn-default restore"
                data-id="{{ $dataTypeContent->getKey() }}" id="restore-{{ $dataTypeContent->getKey() }}">
                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.restore') }}</span>
            </a>
        @else
            <a href="javascript:;" title="{{ __('voyager::generic.delete') }}" class="btn btn-danger delete"
                data-id="{{ $dataTypeContent->getKey() }}" id="delete-{{ $dataTypeContent->getKey() }}">
                <i class="voyager-trash"></i> <span class="hidden-xs hidden-sm">{{ __('voyager::generic.delete') }}</span>
            </a>
        @endif
    @endcan
    @can('browse', $dataTypeContent)
        <a href="{{ route('voyager.' . $dataType->slug . '.index') }}" class="btn btn-warning">
            <i class="glyphicon glyphicon-list"></i> <span
                class="hidden-xs hidden-sm">{{ __('voyager::generic.return_to_list') }}</span>
        </a>
    @endcan
</h1>
@include('voyager::multilingual.language-selector')
@stop
@section('content')
<div class="page-content read container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="panel panel-bordered" style="padding-bottom:5px;">
                <div class="page-content read container-fluid">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="panel panel-bordered" style="padding-bottom:5px; heigh:100%;">
                                <div style="position:relative; z-index:9;">
                                    <h1>{{ ucwords($dataTypeContent->title) }}</h1>
                                    <p>{{ $dataTypeContent->excerpt }}</p>
                                    <p>{!! $dataTypeContent->body !!}</p>
                                    <h5>Publicado por</h5>

                                    @foreach($dataType->readRows as $row)
                                        @if($row->type == 'relationship')
                                            <p>
                                                @include('voyager::formfields.relationship', ['view' => 'read', 'options' => $row->details])
                                            </p>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <img src="{{ Voyager::image($dataTypeContent->image) }}" class="avatar"
                                style="width:450px; height:450px;" alt="{{ $dataTypeContent->name }} avatar">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@stop