<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{

    use HasFactory;
    protected $table = 'stocks'; // Nombre de la tabla

    protected $fillable = ['producto_id', 'cantidad', 'codigo', 'fechaVencimiento'];

    public function producto()
    {
        return $this->belongsTo(Producto::class);
    }
}

