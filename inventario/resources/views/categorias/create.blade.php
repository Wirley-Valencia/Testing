@extends('home')

@section('content')
    <h1>Crear Nueva Categoría</h1>
    <form action="{{ route('categorias.store') }}" method="post">
        @csrf
        <div>
            <label for="nombre">Nombre:</label>
            <input type="text" name="nombre" id="nombre">
        </div>
        <div>
            <label for="descripcion">Descripción:</label>
            <textarea name="descripcion" id="descripcion"></textarea>
        </div>
        <button type="submit">Guardar</button>
    </form>
@endsection