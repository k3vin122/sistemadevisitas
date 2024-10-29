<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Proveedor;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProveedorControllerTest extends TestCase
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
    public function it_displays_index_view_with_proveedors(): void
    {
        $proveedors = Proveedor::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('proveedors.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.proveedors.index')
            ->assertViewHas('proveedors');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_proveedor(): void
    {
        $response = $this->get(route('proveedors.create'));

        $response->assertOk()->assertViewIs('app.proveedors.create');
    }

    /**
     * @test
     */
    public function it_stores_the_proveedor(): void
    {
        $data = Proveedor::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('proveedors.store'), $data);

        $this->assertDatabaseHas('proveedors', $data);

        $proveedor = Proveedor::latest('id')->first();

        $response->assertRedirect(route('proveedors.edit', $proveedor));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_proveedor(): void
    {
        $proveedor = Proveedor::factory()->create();

        $response = $this->get(route('proveedors.show', $proveedor));

        $response
            ->assertOk()
            ->assertViewIs('app.proveedors.show')
            ->assertViewHas('proveedor');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_proveedor(): void
    {
        $proveedor = Proveedor::factory()->create();

        $response = $this->get(route('proveedors.edit', $proveedor));

        $response
            ->assertOk()
            ->assertViewIs('app.proveedors.edit')
            ->assertViewHas('proveedor');
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

        $response = $this->put(route('proveedors.update', $proveedor), $data);

        $data['id'] = $proveedor->id;

        $this->assertDatabaseHas('proveedors', $data);

        $response->assertRedirect(route('proveedors.edit', $proveedor));
    }

    /**
     * @test
     */
    public function it_deletes_the_proveedor(): void
    {
        $proveedor = Proveedor::factory()->create();

        $response = $this->delete(route('proveedors.destroy', $proveedor));

        $response->assertRedirect(route('proveedors.index'));

        $this->assertModelMissing($proveedor);
    }
}
