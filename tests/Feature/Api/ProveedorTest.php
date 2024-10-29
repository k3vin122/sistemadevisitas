<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Proveedor;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProveedorTest extends TestCase
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
    public function it_gets_proveedors_list(): void
    {
        $proveedors = Proveedor::factory()
            ->count(5)
            ->create();

        $response = $this->getJson(route('api.proveedors.index'));

        $response->assertOk()->assertSee($proveedors[0]->nombre);
    }

    /**
     * @test
     */
    public function it_stores_the_proveedor(): void
    {
        $data = Proveedor::factory()
            ->make()
            ->toArray();

        $response = $this->postJson(route('api.proveedors.store'), $data);

        $this->assertDatabaseHas('proveedors', $data);

        $response->assertStatus(201)->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_updates_the_proveedor(): void
    {
        $proveedor = Proveedor::factory()->create();

        $data = [
            'nombre' => $this->faker->text(255),
            'rut' => $this->faker->text(255),
        ];

        $response = $this->putJson(
            route('api.proveedors.update', $proveedor),
            $data
        );

        $data['id'] = $proveedor->id;

        $this->assertDatabaseHas('proveedors', $data);

        $response->assertOk()->assertJsonFragment($data);
    }

    /**
     * @test
     */
    public function it_deletes_the_proveedor(): void
    {
        $proveedor = Proveedor::factory()->create();

        $response = $this->deleteJson(
            route('api.proveedors.destroy', $proveedor)
        );

        $this->assertModelMissing($proveedor);

        $response->assertNoContent();
    }
}
