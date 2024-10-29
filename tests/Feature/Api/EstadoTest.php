<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Estado;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstadoTest extends TestCase
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
    public function it_gets_estados_list(): void
    {
        $estados = Estado::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.estados.index'));

        $response->assertOk()->assertSee($estados[0]->nombre_estado);
    }

    /**
     * @test
     */
    public function it_stores_the_estado(): void
    {
        $data = Estado::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.estados.store'), $data);

        $this->assertDatabaseHas('estados', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_estado(): void
    {
        $estado = Estado::factory()->create();

        $data = [
            'nombre_estado' => $this->faker->text(255),
        ];

        $response = $this->putJson(route('api.estados.update', $estado), $data);

        $data['id'] = $estado->id;

        $this->assertDatabaseHas('estados', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_estado(): void
    {
        $estado = Estado::factory()->create();

        $response = $this->deleteJson(route('api.estados.destroy', $estado));

        $this->assertModelMissing($estado);

        $response->assertNoContent();
    }
}
