@extends('adminlte::page')

@section('title', 'Administrador: Todo Contenido Web')

@section('content_header')
    <h1>Lista de Subcategorías</h1>
@stop

@section('content')

    @if(session('info'))
        <div class="alert alert-success">
            <strong>{{ session('info') }}</strong>
        </div>
    @endif
    
    <div class="card">

        <div class="card-header">
            <a class="btn btn-primary" href="{{ route('admin.subcategories.create') }}">Agregar nueva Subcategoría</a>
        </div>

        <div class="card-body">
            
            <table class="table table-striped">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nombre de la Subcategoría</th>
                        <th>Categoría Relacionada</th>
                        <th colspan="2">Operaciones</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($subcategories as $subcategory)
                        <tr>
                            <td>{{ $subcategory->id }}</td>
                            <td>{{ $subcategory->name }}</td> 
                            <td>{{ $subcategory->category->name }}</td>
                            <td width="10px">
                                <a class="btn btn-primary btn-sm" href="{{ route('admin.subcategories.edit', $subcategory) }}">Editar</a>
                            </td>
                            <td width="10px">
                                <form action="{{ route('admin.subcategories.destroy', $subcategory) }}" method="POST">
                                    @csrf
                                    @method('delete')

                                    <button class="btn btn-danger btn-sm" type="submit">Eliminar</button>
                                
                                </form>
                                
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

@stop