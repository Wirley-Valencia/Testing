<?php

namespace App\Http\Controllers;

use App\Models\Producto;
use App\Models\Categoria;
use Illuminate\Http\Request;
use App\Http\Requests\ProductoRequest;

class ProductoController extends Controller
{
    public function index()
    {
        $productos = Producto::all();
        return view('productos.index', compact('productos'));
    }

    public function create()
    {
        $categorias = Categoria::all(); 
        return view('productos.create', compact('categorias'));
    }

    public function store(ProductoRequest $request)
    {
        // La validación se realiza automáticamente antes de llegar a este punto
        // Si la validación falla, Laravel automáticamente redireccionará de vuelta con los errores
        // Si la validación es exitosa, puedes crear el producto
        $producto = Producto::create($request->all());

        return redirect()->route('productos.index');
    }
    public function edit(Producto $producto)
    {
        $categorias = Categoria::all(); 
        return view('productos.edit', compact('producto', 'categorias'));
    }

    public function update(Request $request, Producto $producto)
    {
        $producto->update($request->all());
        return redirect()->route('productos.index');
    }

    public function destroy(Producto $producto)
    {
        $producto->delete();
        return redirect()->route('productos.index');
    }
}
