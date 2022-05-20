@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Nuevo Etiqueta</h1>
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
        <x-form action="{{ route('tags.store') }}">
            <div class="mb-2">
                <x-form-input name="nombre" label="Nombre" placeholder="Nombre de la etiqueta" required />
            </div>
            <div class="mb-2">
                <x-form-textarea name="descripcion" placeholder="Descripción de la etiqueta" label="Descripción" />
            </div>


            <div class="d-flex flex-row-reverse">

                <button class="btn btn-info" type="submit"><i class="fas fa-fw fa-save"></i>Guardar</button>
                <a href="{{ route('tags.index') }}" class="btn btn-warning mr-2"><i
                        class="fas fa-fw fa-backward"></i>Volver</a>
            </div>


        </x-form>
    </div>
@endsection

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')

@stop
