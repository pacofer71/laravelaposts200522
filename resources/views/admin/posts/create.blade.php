@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nuevo Post</h1>
    <!--
    @if ($errors)
        @foreach ($errors->all() as $error)
            <div>{{ $error }}</div>
        @endforeach
    @endif
    -->
@stop

@section('content')
    <div class="mx-auto rounded px-4 py-4 shadow" style="width:72rem">
        <x-form action="{{ route('posts.store') }}" enctype="multipart/form-data">
            <div class="mb-2">
                <x-form-input name="titulo" label="Título" placeholder="Título" required />
            </div>
            <div class="mb-2">
                <x-form-textarea name="contenido" placeholder="Contenido del post" label="Contenido" />
            </div>
            <div class="mb-2">
                <x-form-group name="estado" label="Estado" inline>
                    <x-form-radio name="estado" value="PUBLICADO" label="Publicado" />
                    <x-form-radio name="estado" value="BORRADOR" label="Borrador" checked />
                </x-form-group>
            </div>

            <div class="mb-2">
                <x-form-select name="category_id" :options="$categories" label="Categoria" />
            </div>

            <div class="mb-2">
                <x-form-group label="Etiquetas" inline>
                    @foreach ($tags as $tag)
                        <x-form-checkbox name="tags[]" label="{{ $tag->nombre }}" value="{{ $tag->id }}" :show-errors="false" />
                    @endforeach
                </x-form-group>
                @error('tags')
                    <div class="mt-2 text-sm text-danger"> *** {{ $message }} </div>
                @enderror
            </div>

            <div class="mb-2 d-flex justify-content-between align-items-center">
                <div>
                    <input type="file" name="image" class="form-control" id="fimg" accept="image/*" />
                    @error('image')
                        <div class="mt-2 text-sm text-danger">*** {{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <img id="img" src="{{ asset('storage/default/noimage.png') }}"
                        style="width:15rem; height:15rem; object-fit: cover; object-position: center;" />
                </div>


            </div>
            <div class="d-flex flex-row-reverse">

                <button class="btn btn-info" type="submit"><i class="fas fa-fw fa-save"></i>Guardar</button>
                <a href="{{ route('posts.index') }}" class="btn btn-warning mr-2"><i
                        class="fas fa-fw fa-backward"></i>Volver</a>
            </div>


        </x-form>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        //Cambiar imagen
        document.getElementById("fimg").addEventListener('change', cambiarImagen);

        function cambiarImagen(event) {
            var file = event.target.files[0];
            var reader = new FileReader();
            reader.onload = (event) => {
                document.getElementById("img").setAttribute('src', event.target.result)
            };
            reader.readAsDataURL(file);
        }
    </script>
@stop
