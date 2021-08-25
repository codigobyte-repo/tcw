@extends('adminlte::page')

@section('title', 'Administrador: Todo Contenido Web')

@section('content_header')
    <h1>Editar Post</h1>
@stop

@section('content')
    
    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif

    <div class="card">

        <div class="card-body">

            {!! Form::model($post,['route' => ['admin.posts.update', $post], 'autocomplete' => 'off', 'files' => true, 'method' => 'put']) !!}

                    @include('admin.posts.partials.form')

                {!! Form::submit('Actualizar publicidad', ['class' => 'btn btn-primary']) !!}

            {!! Form::close() !!}
        </div>

    </div>

@stop

@section('css')
    <style>
        .image-wrapper{
            position: relative;
            padding-bottom: 56.25%;
        }
        
        .image-wrapper img {
            position: absolute;
            object-fit: cover;
            width: 100%;
            height: 100%;
            border-radius: 25px;
            box-shadow: 10px 5px 5px gray;
        }
        
    </style>
@stop

@section('js')

    {{-- GENERAR SLUG CON JQUERY --}}
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

    {{-- CKEDITOR --}}
    <script src="https://cdn.ckeditor.com/ckeditor5/28.0.0/classic/ckeditor.js"></script>
    <script>
        ClassicEditor
            .create( document.querySelector( '#description' ) )
            .catch( error => {
                console.error( error );
            } );
    </script>

    {{-- PREVISUALIZACIÓN DE IMAGEN EN EL VISOR --}}
    <script>
        document.getElementById("file").addEventListener('change', cambiarImagen);

        function cambiarImagen(event){
            var file = event.target.files[0];

            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("picture").setAttribute('src', event.target.result);
            };

            reader.readAsDataURL(file);
        }
    </script>

    <script>
            
        /* INFO: https://youtu.be/mYVl4lUadcs */

        /* ECMASCRIPT 6 */
        $(document).on("change", "#category_id",event => {
            
            $.get(`../../getSubCategories/${event.target.value}`, function(response, state){
                $("#subcategory").empty();
                if(response != ''){
                    response.forEach(element => {
                        $("#subcategory").append(`<option value=${element.id}> ${element.name} </option>`);
                    });
                }else{
                    $("#subcategory").append(`<option> No hay subcategorías </option>`);
                }
            });
        });

    </script>

@endsection
