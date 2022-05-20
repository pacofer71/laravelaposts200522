@extends('adminlte::page')

@section('title', 'Dashboard')

@section('content_header')
    <h1>Etiquetas</h1>
@stop

@section('content')
<div class="mb-4 d-flex flex-row-reverse">
    <a href="{{route('tags.create')}}" class='btn btn-sm btn-success'><i class="fas fa-plus fa-fw"></i>Crear Nueva</a>
</div>
    <table class="table" id="tabla">
        <thead>
            <tr class="bg-info">
                <th scope="col">#</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripción</th>


                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($tags as $item)
                <tr>
                    <th scope="row">{{ $item->id }}</th>
                    <td>{{ $item->nombre }}</td>
                    <td class="text-secundary align-middle">{{$item->descripcion}}</td>
                    <td>
                        <form action="{{route('tags.destroy', $item)}}" method="post" class="form-inline">
                            @csrf
                            @method('DELETE')
                            <a href="{{ route('tags.edit', $item) }}" class="btn  btn-warning mr-2"><i
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
