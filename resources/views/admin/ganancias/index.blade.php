@extends('adminlte::page')

@section('title', 'Administrador: Wootrap')

@section('content_header')
    <h1>Mis ganancias</h1>
@stop

@section('content')

    
    <div class="card">
    
    
        @if($pagos->count())
            <div class="card-body">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>                         
                            <th>Comisión</th>
                            <th>Ganancia</th>
                        </tr>
                    </thead>
    
                    <tbody>
                        @foreach($pagos as $pago)
                            <tr>
                                
                                <td>{{ $pago->id }}</td>
                                <td>{{ $pago->commission }} %</td>
                                <td class="text-success font-weight-bold">USD {{ $pago->totalConComision - $pago->total }}</td>

                            </tr>
                        @endforeach
                    </tbody>
                </table>    
            </div>
    
            <div class="card-footer">
                {{ $pagos->links('pagination::bootstrap-4') }}
            </div>
        
        @else
            <div class="card-body">
                <strong>No hay ningún registro coincidente</strong>
            </div>
        @endif
    </div>


@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop