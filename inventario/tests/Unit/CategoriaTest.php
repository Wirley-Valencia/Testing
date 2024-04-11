<?php

namespace Tests\Unit;

use App\Models\Categoria;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class CategoriaTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function crear_una_categoria()
    {
        $response = $this->post(route('categorias.store'), [
            'nombre' => 'Categoria de prueba',
            'descripcion' => 'Descripción de la categoría de prueba',
        ]);

        $response->assertRedirect(route('categorias.index'));

        $this->assertDatabaseHas('categorias', [
            'nombre' => 'Categoria de prueba',
            'descripcion' => 'Descripción de la categoría de prueba',
        ]);
    }

    /** @test */
    public function actualizar_una_categoria()
    {
        $categoria = Categoria::create([
            'nombre' => 'Categoria existente',
            'descripcion' => 'Descripción de la categoría existente',
        ]);

        $response = $this->put(route('categorias.update', $categoria), [
            'nombre' => 'Nuevo nombre de categoría',
            'descripcion' => 'Nueva descripción de categoría',
        ]);

        $response->assertRedirect(route('categorias.index'));

        $this->assertDatabaseHas('categorias', [
            'nombre' => 'Nuevo nombre de categoría',
            'descripcion' => 'Nueva descripción de categoría',
        ]);
    }

    /** @test */
    public function eliminar_una_categoria()
    {
        $categoria = Categoria::create([
            'nombre' => 'Categoria a eliminar',
            'descripcion' => 'Descripción de la categoría a eliminar',
        ]);

        $response = $this->delete(route('categorias.destroy', $categoria));

        $response->assertRedirect(route('categorias.index'));

        $this->assertDatabaseMissing('categorias', ['id' => $categoria->id]);
    }

    /** @test */
    
}
