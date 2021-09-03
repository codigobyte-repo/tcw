@extends('adminlte::page')

@section('title', 'Administrador: Todo Contenido Web')

@section('content_header')

@stop

@section('content')
    
    <div class="container px-4 py-5" id="featured-3">
        <h2 class="pb-2 border-bottom">Opciones del sistema</h2>
        <p>Bienvenido al panel administrativo de <b>Todo Contenido Web</b>. Desde esta sección va poder administrar las configuraciones internas del sistema.</p>
        <p>Lo invitamos a descubrir las funcionalidades, tenga en cuenta que esta sección trabaja directamente con los datos sensibles del sistema.</p>

        <div class="row g-4 py-5 row-cols-1 row-cols-lg-3">
          <div class="feature col">
            <div class="feature-icon bg-primary bg-gradient">
              <svg class="bi" width="1em" height="1em"><use xlink:href="#collection"/></svg>
            </div>
            <h2>Usuarios</h2>
            <p>Aquí podrá ver todos los usuarios del sistema y asignarle un nuevo rol.</p>
            <a href="{{ route('admin.users.index') }}" class="icon-link">
              Ver usuarios
              <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
            </a>
          </div>
          <div class="feature col">
            <div class="feature-icon bg-primary bg-gradient">
              <svg class="bi" width="1em" height="1em"><use xlink:href="#people-circle"/></svg>
            </div>
            <h2>Lista de roles</h2>
            <p>En esta sección podrá administrar los permisos como así también generar nuevos roles.</p>
            <a href="{{ route('admin.roles.index') }}" class="icon-link">
              Ver roles
              <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
            </a>
          </div>
          <div class="feature col">
            <div class="feature-icon bg-primary bg-gradient">
              <svg class="bi" width="1em" height="1em"><use xlink:href="#toggles2"/></svg>
            </div>
            <h2>Pendientes de aprobación</h2>
            <p>Desde aquí podrá administrar las publicaciones y cambiar los estados de las mismas.</p>
            <a href="{{ route('admin.post-status.index') }}" class="icon-link">
              Ver pendientes de aprobación
              <svg class="bi" width="1em" height="1em"><use xlink:href="#chevron-right"/></svg>
            </a>
          </div>
        </div>
      </div>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script> console.log('Hi!'); </script>
@stop