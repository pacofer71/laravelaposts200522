@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Categorías</h1>
@stop

@section('content')
<div class="mb-4 d-flex flex-row-reverse">
    <a href="{{route('categories.create')}}" class='btn btn-sm btn-success'><i class="fas fa-plus fa-fw"></i>Crear Nueva</a>
</div>
    <table class="table" id="tabla">
        <thead>
            <tr class="bg-info">
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>
                <th scope="col">Imagen</th>

                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($categories as $item)
                <tr>
                    <th scope="row" class="align-middle">{{ $item->id }}</th>
                    <td class="align-middle">{{ $item->nombre }}</td>
                    <td class="text-secundary align-middle">{{$item->descripcion}}</td>
                    <td><img src="{{Storage::url($item->image->url)}}" class="rounded" style="width:5rem; height:5rem; object-fit: cover; object-position: center;" /></td>
                    <td class="align-middle">
                        <form action="{{route('categories.destroy', $item)}}" method="post" class="form-inline">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('categories.edit', $item) }}" class="btn  btn-warning mr-2"><i
                                    class="fas fa-edit"></i></a>
                            <button type='submit' class="btn  btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>

    </table>
@stop

@section('css')
    <link rel="stylesheet" href="/css/admin_custom.css">
@stop

@section('js')
    <script>
        $(document).ready(function() {
            $('#tabla').DataTable();
        });
    </script>
    @if (session('info'))
        <script>
            Swal.fire({
                type: 'success',
                title: '{{session('info')}}',
                showConfirmButton: false,
                timer: 1500
            })
        </script>
    @endif
@stop
