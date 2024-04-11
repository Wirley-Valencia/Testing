<?php

namespace Tests\Unit;

use App\Models\Categoria;
use App\Models\Producto;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ProductoTest extends TestCase
{
    use RefreshDatabase;

    protected $categoria;
    protected $otraCategoria;
    protected $producto;

    public function setUp(): void
    {
        parent::setUp();

       
        $this->categoria = Categoria::create([
            'nombre' => 'Categoria 1',
            'descripcion' => 'Descripción de la categoría 1',
        ]);

        $this->otraCategoria = Categoria::create([
            'nombre' => 'Categoria 2',
            'descripcion' => 'Descripción de la categoría 2',
        ]);

 
        $this->producto = Producto::create([
            'nombre' => 'Producto de prueba',
            'descripcion' => 'Descripción del producto de prueba',
            'precio' => 10.99,
            'categoria_id' => $this->categoria->id,
        ]);
    }

    /** @test */
    public function crear_un_producto()
    {
        
        $this->assertDatabaseHas('productos', [
            'nombre' => 'Producto de prueba',
            'descripcion' => 'Descripción del producto de prueba',
            'precio' => 10.99,
            'categoria_id' => $this->categoria->id,
        ]);
    }

    /** @test */
    public function actualizar_un_producto()
    {
        
        $this->producto->update([
            'nombre' => 'Nuevo nombre de producto',
            'descripcion' => 'Nueva descripción de producto',
            'precio' => 20.99,
            'categoria_id' => $this->otraCategoria->id,
        ]);

        
        $this->assertEquals('Nuevo nombre de producto', $this->producto->fresh()->nombre);
        $this->assertEquals('Nueva descripción de producto', $this->producto->fresh()->descripcion);
        $this->assertEquals(20.99, $this->producto->fresh()->precio);
    }

    /** @test */
    public function eliminar_un_producto()
    {
        
        $this->producto->delete();

        
        $this->assertDatabaseMissing('productos', ['id' => $this->producto->id]);
    }

    /** @test */
    public function validacion_precio()
    {
        $response = $this->post('/productos', [
            'cantidad' => 10,
            'precio' => 1234567, // Más de 6 dígitos
        ]);

        $response->assertSessionHasErrors('precio');
    }
}
