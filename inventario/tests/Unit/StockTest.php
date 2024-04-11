<?php

namespace Tests\Unit;

use App\Models\Producto;
use App\Models\Stock;
use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class StockTest extends TestCase
{
    use RefreshDatabase;

    protected $producto;
    protected $stock;

    public function setUp(): void
    {
        parent::setUp();

        // Creamos una categoría
        $categoria = Categoria::create([
            'nombre' => 'Categoria de prueba',
            'descripcion' => 'Descripción de la categoría de prueba',
        ]);

        
        $this->producto = Producto::create([
            'nombre' => 'Producto de prueba',
            'descripcion' => 'Descripción del producto de prueba',
            'precio' => 10.99,
            'categoria_id' => $categoria->id, 
        ]);

        
        $this->stock = Stock::create([
            'producto_id' => $this->producto->id,
            'cantidad' => 10,
            'codigo' => 'ABC123',
            'fechaVencimiento' => now()->addMonth(),
        ]);
    }
    /** @test */
    public function crear_un_stock()
    {
        
        $this->assertDatabaseHas('stocks', [
            'producto_id' => $this->producto->id,
            'cantidad' => 10,
            'codigo' => 'ABC123',
            'fechaVencimiento' => $this->stock->fechaVencimiento->toDateString(),
        ]);
    }

    /** @test */
public function actualizar_un_stock()
{
    
    $this->stock->update([
        'cantidad' => 15,
        'codigo' => 'XYZ789',
        'fechaVencimiento' => now()->addDays(10)->toDateString(), 
    ]);

    
    $this->assertEquals(15, $this->stock->fresh()->cantidad);
    $this->assertEquals('XYZ789', $this->stock->fresh()->codigo);
    $this->assertEquals(now()->addDays(10)->toDateString(), $this->stock->fresh()->fechaVencimiento); // Ya que es una cadena de texto, no es necesario llamar a toDateString()
}
    /** @test */
    public function eliminar_un_stock()
    {
        
        $this->stock->delete();

        
        $this->assertDatabaseMissing('stocks', ['id' => $this->stock->id]);
    }

     /** @test */
     public function cantidad_no_puede_ser_menor_a_cero()
     {
         $response = $this->post('/stocks', [
             'cantidad' => -1,
         ]);
 
         $response->assertSessionHasErrors('cantidad');
         $this->assertStringContainsString('La cantidad no puede ser menor a 0.', session('errors')->first('cantidad'));
     }
 
     /** @test */
     public function cantidad_no_puede_tener_mas_de_tres_digitos()
     {
         $response = $this->post('/stocks', [
             'cantidad' => 1000,
         ]);
 
         $response->assertSessionHasErrors('cantidad');
         $this->assertStringContainsString('La cantidad no puede tener mas de tres digitos', session('errors')->first('cantidad'));
     }
 
     /** @test */
     public function cantidad_puede_ser_cero()
     {
         $response = $this->post('/stocks', [
             'cantidad' => 0,
         ]);
 
         $response->assertSessionHasNoErrors('cantidad');
     }
 


}
