<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Estado;
use App\Models\Registro;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstadoRegistrosTest extends TestCase
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
    public function it_gets_estado_registros(): void
    {
        $estado = Estado::factory()->create();
        $registros = Registro::factory()
            ->count(2)
            ->create([
                'estado_id' => $estado->id,
            ]);

        $response = $this->getJson(
            route('api.estados.registros.index', $estado)
        );

        $response->assertOk()->assertSee($registros[0]->rut);
    }

    /**
     * @test
     */
    public function it_stores_the_estado_registros(): void
    {
        $estado = Estado::factory()->create();
        $data = Registro::factory()
            ->make([
                'estado_id' => $estado->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.estados.registros.store', $estado),
            $data
        );

        $this->assertDatabaseHas('registros', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $registro = Registro::latest('id')->first();

        $this->assertEquals($estado->id, $registro->estado_id);
    }
}
