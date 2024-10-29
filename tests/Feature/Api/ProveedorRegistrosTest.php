<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Registro;
use App\Models\Proveedor;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProveedorRegistrosTest extends TestCase
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
    public function it_gets_proveedor_registros(): void
    {
        $proveedor = Proveedor::factory()->create();
        $registros = Registro::factory()
            ->count(2)
            ->create([
                'proveedor_id' => $proveedor->id,
            ]);

        $response = $this->getJson(
            route('api.proveedors.registros.index', $proveedor)
        );

        $response->assertOk()->assertSee($registros[0]->rut);
    }

    /**
     * @test
     */
    public function it_stores_the_proveedor_registros(): void
    {
        $proveedor = Proveedor::factory()->create();
        $data = Registro::factory()
            ->make([
                'proveedor_id' => $proveedor->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.proveedors.registros.store', $proveedor),
            $data
        );

        $this->assertDatabaseHas('registros', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $registro = Registro::latest('id')->first();

        $this->assertEquals($proveedor->id, $registro->proveedor_id);
    }
}
