@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Editar Caregoría</h1>
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
        <x-form action="{{ route('categories.update', $category) }}" enctype="multipart/form-data">
            @method('PUT')
            @bind($category)
            <div class="mb-2">
                <x-form-input name="nombre" label="Nombre" placeholder="Nombre de Categoría" required />
            </div>
            <div class="mb-2">
                <x-form-textarea name="descripcion" placeholder="Descripción de la Categoría" label="Descripción" />
            </div>
            @endbind
            <div class="mb-2 d-flex justify-content-between align-items-center">
                <div>
                    <input type="file" name="image" class="form-control" id="fimg" accept="image/*" />
                    @error('image')
                        <div class="mt-2 text-sm text-danger">*** {{ $message }}</div>
                    @enderror
                </div>
                <div>
                    <img id="img" src="{{ Storage::url($category->image->url) }}"
                        style="width:15rem; height:15rem; object-fit: cover; object-position: center;" />
                </div>


            </div>
            <div class="d-flex flex-row-reverse">

                <button class="btn btn-info" type="submit"><i class="fas fa-fw fa-edit"></i>Editar</button>
                <a href="{{ route('categories.index') }}" class="btn btn-warning mr-2"><i
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
