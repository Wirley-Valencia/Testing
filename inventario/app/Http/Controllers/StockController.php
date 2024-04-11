<?php

namespace App\Http\Controllers;

use App\Models\Stock;
use App\Models\Producto;
use Illuminate\Http\Request;
use App\Http\Requests\StockRequest;

class StockController extends Controller
{
    public function index()
    {
        $stocks = Stock::all();
        return view('stocks.index', compact('stocks'));
    }

    public function create()
    {
        $productos = Producto::all();
        return view('stocks.create', compact('productos'));
    }

    public function store(StockRequest $request)
    {
        // La validación se realiza automáticamente antes de llegar a este punto
        // Si la validación falla, Laravel automáticamente redireccionará de vuelta con los errores
        // Si la validación es exitosa, puedes crear el stock
        $stock = Stock::create($request->all());

        return redirect()->route('stocks.index');
    }

    public function edit(Stock $stock)
    {
        $productos = Producto::all();
        return view('stocks.edit', compact('stock','productos'));
    }

    public function update(Request $request, Stock $stock)
    {
        $stock->update($request->all());
        return redirect()->route('stocks.index');
    }

    public function destroy(Stock $stock)
    {
        $stock->delete();
        return redirect()->route('stocks.index');
    }
}
