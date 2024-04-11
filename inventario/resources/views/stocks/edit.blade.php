@extends('home')

@section('content')
    <h1>Editar Stock</h1>
    <form action="{{ route('stocks.update', $stock->id) }}" method="post">
        @csrf
        @method('PUT')
        <div class="form-group">
            <label for="producto_id">Producto:</label>
            <select name="producto_id" id="producto_id" class="form-control">
                @foreach($productos as $producto)
                    <option value="{{ $producto->id }}" @if($stock->producto_id == $producto->id) selected @endif>{{ $producto->nombre }}</option>
                @endforeach
            </select>
        </div>
        <div class="form-group">
            <label for="cantidad">Cantidad:</label>
            <input type="number" name="cantidad" id="cantidad" class="form-control" value="{{ $stock->cantidad }}">
            @error('cantidad')
            <span>{{ $message }}</span>
        @enderror
        </div>
        <div class="form-group">
            <label for="codigo">Código:</label>
            <input type="text" name="codigo" id="codigo" class="form-control" value="{{ $stock->codigo }}">
        </div>
        <div class="form-group">
            <label for="fechaVencimiento">Fecha de Vencimiento:</label>
            <input type="date" name="fechaVencimiento" id="fechaVencimiento" class="form-control" value="{{ $stock->fechaVencimiento }}">
        </div>
        <button type="submit" class="btn btn-primary">Actualizar</button>
    </form>
@endsection
