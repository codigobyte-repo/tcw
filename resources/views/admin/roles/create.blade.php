@extends('adminlte::page')

@section('title', 'Administrador: Todo Contenido Web')

@section('content_header')
    <h1>Crear nuevo roles</h1>
@stop

@section('content')
    
    <div class="card">

        <div class="card-body">
            {!! Form::open(['route' => 'admin.roles.store']) !!}

                @include('admin.roles.partials.form')

                {!! Form::submit('Crear rol', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>

    </div>

@stop

@section('js')

    <script src="{{ asset('vendor/jQuery-Plugin-stringToSlug-1.3/jquery.stringToSlug.min.js') }}"></script>

    <script>
        $(document).ready( function() {
            $("#name").stringToSlug({
                setEvents: 'keyup keydown blur',
                getPut: '#slug',
                space: '-'
            });
        });
    </script>

@endsection