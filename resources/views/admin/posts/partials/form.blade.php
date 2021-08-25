<div class="form-group">
    {!! Form::label('name', 'Nombre') !!}
    {!! Form::text('name', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre de la publicación']) !!}

    @error('name')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>

<div class="form-group">
    {!! Form::label('slug', 'Slug o Url de la dirección') !!}
    {!! Form::text('slug', null, ['class' => 'form-control', 'placeholder' => 'Ingrese el nombre del Slug', 'readonly']) !!}

    @error('slug')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>


<div class="form-group">
    {!! Form::label('category_id', 'Categoría') !!}
    {!! Form::select('category_id', $categories, null, ['class' => 'form-control', 'placeholder' => 'Seleccionar categoría']) !!}

    @error('category_id')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="form-group">
    {!! Form::label('subcategory', 'Subcategoría') !!}
    {!! Form::select('subcategory', $subcategories, null, ['class' => 'form-control', 'placeholder' => 'Seleccionar Subcategoría']) !!}

    @error('subcategory')
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>


<div class="form-group">
    <p class="font-weight-bold">Etiquetas</p>

    @foreach($tags as $tag)
        <label class="mr-2">
            {!! Form::checkbox('tags[]', $tag->id, null) !!}
            {{ $tag->name }}
        </label>
    @endforeach

    @error('tags')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="form-group">
    <p class="font-weight-bold">Estado</p>
    <label>
        {!! Form::radio('status', 1, true) !!}
        Borrador
    </label>
    <label>
        {!! Form::radio('status', 2) !!}
        Publicado
    </label>

    @error('status')
        <br>
        <small class="text-danger">{{ $message }}</small>
    @enderror

</div>

<div class="row mb-3">
    <div class="col">
        <div class="image-wrapper">
            @isset ($post->image)
                <img id="picture" src="{{Storage::url($post->image->url)}}" alt="Imagen del Post">
            @else
                <img id="picture" src="{{asset('img/fondo/fondoPost.webp')}}" alt="Imagen del Post">
            @endisset
        </div>
    </div>

    <div class="col">
        <div class="form-group">
            {!! Form::label('file', 'Imagen de la publicación') !!}
            {!! Form::file('file', ['class' => 'form-control-file', 'accept' => 'image/*']) !!}

            @error('file')
                <span class="text-danger">{{ $message }}</span>
            @enderror
        </div>

        

        <p>La imagen que utilices será la portada de tu publicación, por favor selecciona una imagen representativa al servicio que estás ofreciendo. Es importante que selecciones una imagen con buena calidad. Por favor selecciona sólo imágenes de resolución máxima de 6000px por 6000px</p>
    </div>
</div>

<div class="form-group">
    {!! Form::label('description', 'Contenido de la publicación') !!}
    {!! Form::textarea('description', null, ['class' => 'form-control']) !!}

    @error('description')
        <small class="text-danger">{{ $message }}</small>
    @enderror
</div>