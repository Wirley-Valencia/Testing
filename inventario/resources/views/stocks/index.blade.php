@extends('home')

@section('content')
    <h1>Listado de Stocks</h1>
    <a href="{{ route('stocks.create') }}" class="btn btn-primary">Crear Stock</a>
    <table class="table table-primary">
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Código</th>
                <th>Fecha de Vencimiento</th>
                <th>Editar</th>
                <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @foreach($stocks as $stock)
                <tr>
                    <td>{{ $stock->producto->nombre }}</td>
                    <td>{{ $stock->cantidad }}</td>
                    <td>{{ $stock->codigo }}</td>
                    <td>{{ $stock->fechaVencimiento }}</td>
                    <td><a href="{{ route('stocks.edit', $stock->id) }}" class="btn btn-info">Editar</a></td>
                    <td>
                        <form action="{{ route('stocks.destroy', $stock->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>
@endsection
