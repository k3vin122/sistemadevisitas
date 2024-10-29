<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Registro;

use App\Models\Estado;
use App\Models\Proveedor;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistroControllerTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $this->actingAs(
            User::factory()->create(['email' => 'admin@admin.com'])
        );

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_displays_index_view_with_registros(): void
    {
        $registros = Registro::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('registros.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.registros.index')
            ->assertViewHas('registros');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_registro(): void
    {
        $response = $this->get(route('registros.create'));

        $response->assertOk()->assertViewIs('app.registros.create');
    }

    /**
     * @test
     */
    public function it_stores_the_registro(): void
    {
        $data = Registro::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('registros.store'), $data);

        $this->assertDatabaseHas('registros', $data);

        $registro = Registro::latest('id')->first();

        $response->assertRedirect(route('registros.edit', $registro));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_registro(): void
    {
        $registro = Registro::factory()->create();

        $response = $this->get(route('registros.show', $registro));

        $response
            ->assertOk()
            ->assertViewIs('app.registros.show')
            ->assertViewHas('registro');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_registro(): void
    {
        $registro = Registro::factory()->create();

        $response = $this->get(route('registros.edit', $registro));

        $response
            ->assertOk()
            ->assertViewIs('app.registros.edit')
            ->assertViewHas('registro');
    }

    /**
     * @test
     */
    public function it_updates_the_registro(): void
    {
        $registro = Registro::factory()->create();

        $estado = Estado::factory()->create();
        $proveedor = Proveedor::factory()->create();
        $user = User::factory()->create();

        $data = [
            'rut' => $this->faker->text(255),
            'nombres' => $this->faker->text(255),
            'apellidos' => $this->faker->text(255),
            'motivo' => $this->faker->text(255),
            'estado_id' => $estado->id,
            'proveedor_id' => $proveedor->id,
            'user_id' => $user->id,
        ];

        $response = $this->put(route('registros.update', $registro), $data);

        $data['id'] = $registro->id;

        $this->assertDatabaseHas('registros', $data);

        $response->assertRedirect(route('registros.edit', $registro));
    }

    /**
     * @test
     */
    public function it_deletes_the_registro(): void
    {
        $registro = Registro::factory()->create();

        $response = $this->delete(route('registros.destroy', $registro));

        $response->assertRedirect(route('registros.index'));

        $this->assertModelMissing($registro);
    }
}
