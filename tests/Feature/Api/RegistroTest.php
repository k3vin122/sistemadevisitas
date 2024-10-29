<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Registro;

use App\Models\Estado;
use App\Models\Proveedor;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class RegistroTest extends TestCase
{
    use RefreshDatabase, WithFaker;

    protected function setUp(): void
    {
        parent::setUp();

        $user = User::factory()->create(['email' => 'admin@admin.com']);

        Sanctum::actingAs($user, [], 'web');

        $this->seed(\Database\Seeders\PermissionsSeeder::class);

        $this->withoutExceptionHandling();
    }

    /**
     * @test
     */
    public function it_gets_registros_list(): void
    {
        $registros = Registro::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.registros.index'));

        $response->assertOk()->assertSee($registros[0]->rut);
    }

    /**
     * @test
     */
    public function it_stores_the_registro(): void
    {
        $data = Registro::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.registros.store'), $data);

        $this->assertDatabaseHas('registros', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
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

        $response = $this->putJson(
            route('api.registros.update', $registro),
            $data
        );

        $data['id'] = $registro->id;

        $this->assertDatabaseHas('registros', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_registro(): void
    {
        $registro = Registro::factory()->create();

        $response = $this->deleteJson(
            route('api.registros.destroy', $registro)
        );

        $this->assertModelMissing($registro);

        $response->assertNoContent();
    }
}
