@extends('adminlte::page')

@section('title', 'Administrador: Wootrap')

@section('content_header')
    <h1>Lista de pagos a proveedores</h1>
@stop

@section('content')


    @livewire('admin.proveedores.pagos')

@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop