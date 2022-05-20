@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Posts</h1>
@stop

@section('content')
<div class="mb-4 d-flex flex-row-reverse">
    <a href="{{route('posts.create')}}" class='btn btn-sm btn-success'><i class="fas fa-plus fa-fw"></i>Crear Nuevo</a>
</div>
    <table class="table" id="tabla">
        <thead>
            <tr class="bg-info">
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Categoría</th>
                <th scope="col">Estado</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($posts as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->titulo }}</td>
                    <td>{{ $item->category->nombre }}</td>
                    <td class="@if ($item->estado == 'PUBLICADO') text-success @else text-danger @endif px-2 py-2 rounded">
                        {{ $item->estado }}</td>
                    <td>
                        <form action="{{route('posts.destroy', $item)}}" method="post" class="form-inline">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('posts.edit', $item) }}" class="btn btn-sm btn-warning mr-2"><i
                                    class="fas fa-edit"></i></a>
                            <button type='submit' class="btn btn-sm btn-danger"><i class="fas fa-trash"></i></button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
        <tfoot class="bg-secondary">
            <tr>
                <th scope="col">#</th>
                <th scope="col">Título</th>
                <th scope="col">Categoría</th>
                <th scope="col">Estado</th>
                <th>

                </th>
            </tr>
        </tfoot>
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
