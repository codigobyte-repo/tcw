@extends('adminlte::page')

@section('title', 'Administrador: Wootrap')

@section('content_header')
    <h1>Editar Subcategorías</h1>
@stop

@section('content')
    
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">
        <div class="card-body">
            {!! Form::model($subcategory, ['route' => ['admin.subcategories.update', $subcategory], 'method' => 'put']) !!}

                @include('admin.subcategories.partials.form')

                {!! Form::submit('Actualizar Subcategoría', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>

    </div>

@stop