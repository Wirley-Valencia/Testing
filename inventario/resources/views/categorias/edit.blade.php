@extends('home')

@section('content')
    <h1>Editar Categoría</h1>
    <form action="{{ route('categorias.update', $categoria->id) }}" method="post">
        @csrf
        @method('PUT')
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre" value="{{ $categoria->nombre }}">
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion">{{ $categoria->descripcion }}</textarea>
        </div>
        <button type="submit">Actualizar</button>
    </form>
@endsection