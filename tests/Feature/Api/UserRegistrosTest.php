<?php

namespace Tests\Feature\Api;

use App\Models\User;
use App\Models\Registro;

use Tests\TestCase;
use Laravel\Sanctum\Sanctum;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class UserRegistrosTest extends TestCase
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
    public function it_gets_user_registros(): void
    {
        $user = User::factory()->create();
        $registros = Registro::factory()
            ->count(2)
            ->create([
                'user_id' => $user->id,
            ]);

        $response = $this->getJson(route('api.users.registros.index', $user));

        $response->assertOk()->assertSee($registros[0]->rut);
    }

    /**
     * @test
     */
    public function it_stores_the_user_registros(): void
    {
        $user = User::factory()->create();
        $data = Registro::factory()
            ->make([
                'user_id' => $user->id,
            ])
            ->toArray();

        $response = $this->postJson(
            route('api.users.registros.store', $user),
            $data
        );

        $this->assertDatabaseHas('registros', $data);

        $response->assertStatus(201)->assertJsonFragment($data);

        $registro = Registro::latest('id')->first();

        $this->assertEquals($user->id, $registro->user_id);
    }
}
