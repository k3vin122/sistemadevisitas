<?php

namespace Tests\Feature\Controllers;

use App\Models\User;
use App\Models\Estado;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EstadoControllerTest extends TestCase
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
    public function it_displays_index_view_with_estados(): void
    {
        $estados = Estado::factory()
            ->count(5)
            ->create();

        $response = $this->get(route('estados.index'));

        $response
            ->assertOk()
            ->assertViewIs('app.estados.index')
            ->assertViewHas('estados');
    }

    /**
     * @test
     */
    public function it_displays_create_view_for_estado(): void
    {
        $response = $this->get(route('estados.create'));

        $response->assertOk()->assertViewIs('app.estados.create');
    }

    /**
     * @test
     */
    public function it_stores_the_estado(): void
    {
        $data = Estado::factory()
            ->make()
            ->toArray();

        $response = $this->post(route('estados.store'), $data);

        $this->assertDatabaseHas('estados', $data);

        $estado = Estado::latest('id')->first();

        $response->assertRedirect(route('estados.edit', $estado));
    }

    /**
     * @test
     */
    public function it_displays_show_view_for_estado(): void
    {
        $estado = Estado::factory()->create();

        $response = $this->get(route('estados.show', $estado));

        $response
            ->assertOk()
            ->assertViewIs('app.estados.show')
            ->assertViewHas('estado');
    }

    /**
     * @test
     */
    public function it_displays_edit_view_for_estado(): void
    {
        $estado = Estado::factory()->create();

        $response = $this->get(route('estados.edit', $estado));

        $response
            ->assertOk()
            ->assertViewIs('app.estados.edit')
            ->assertViewHas('estado');
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

        $response = $this->put(route('estados.update', $estado), $data);

        $data['id'] = $estado->id;

        $this->assertDatabaseHas('estados', $data);

        $response->assertRedirect(route('estados.edit', $estado));
    }

    /**
     * @test
     */
    public function it_deletes_the_estado(): void
    {
        $estado = Estado::factory()->create();

        $response = $this->delete(route('estados.destroy', $estado));

        $response->assertRedirect(route('estados.index'));

        $this->assertModelMissing($estado);
    }
}
