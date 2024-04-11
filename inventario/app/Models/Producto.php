<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Producto extends Model
{
    use HasFactory;

    protected $table = 'productos'; // Nombre de la tabla

    protected $fillable = ['nombre', 'descripcion', 'precio', 'categoria_id'];

    // Relación con la categoría
    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    // Relación con los stocks
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }

    // Define el atributo calculado 'total_stock' que es la suma de la cantidad de stock del producto
    protected $appends = ['total_stock'];

    // Define el accessor para el atributo 'total_stock'
    public function getTotalStockAttribute()
    {
        // Utiliza el método withSum para cargar el total de la cantidad de stock del producto
        return $this->stocks()->sum('cantidad');
    }
}
