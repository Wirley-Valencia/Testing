@extends('home')
@section('content')
 
<div class="row"></div>
<h1>Listado de Categorías</h1>
<a href="{{ route('categorias.create') }}" class="btn btn-primary">Crear Categoría</a>
    <div class="col-md-2"></div>
    <div class="col-md-8">
        <div class="table-responsive">
            <table class="table table-primary">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Descripción</th>
                        <th>Editar</th>
                        <th>Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categorias as $categoria)
                    <tr>
                        <td>{{ $categoria->nombre }}</td>
                        <td>{{ $categoria->descripcion }}</td>
                        <td><a href="{{ route('categorias.edit', $categoria->id) }}" class="btn btn-info">Editar</a></td>
                        <td>
                            <form action="{{ route('categorias.destroy', $categoria->id) }}" method="post" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Eliminar</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            
        </div>
    </div>
    <div class="col-md-2"></div>


@endsection