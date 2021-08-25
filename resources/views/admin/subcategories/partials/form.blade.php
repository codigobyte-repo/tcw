<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la Sucategoría']) !!}

    @error('name')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug o Url de la Sub Categoría') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del Slug', 'readonly']) !!}

    @error('slug')
        <span class="text-danger">{{ $message }}</span>
    @enderror
</div>

<h2 class="h3">Seleccione a que categoría corresponde</h2>

@foreach($categories as $category)
    <div>
        <label>
            {!! Form::radio('category_id', $category->id, null, ['class' => 'mr-1']) !!}
            {{ $category->name }}
        </label>
    </div>
@endforeach