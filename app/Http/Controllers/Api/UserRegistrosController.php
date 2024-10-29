<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegistroResource;
use App\Http\Resources\RegistroCollection;

class UserRegistrosController extends Controller
{
    public function index(Request $request, User $user): RegistroCollection
    {
        $this->authorize('view', $user);

        $search = $request->get('search', '');

        $registros = $user
            ->registros()
            ->search($search)
            ->latest()
            ->paginate();

        return new RegistroCollection($registros);
    }

    public function store(Request $request, User $user): RegistroResource
    {
        $this->authorize('create', Registro::class);

        $validated = $request->validate([
            'rut' => ['required', 'max:255', 'string'],
            'nombres' => ['required', 'max:255', 'string'],
            'apellidos' => ['required', 'max:255', 'string'],
            'proveedor_id' => ['required', 'exists:proveedors,id'],
            'motivo' => ['required', 'max:255', 'string'],
            'estado_id' => ['required', 'exists:estados,id'],
        ]);

        $registro = $user->registros()->create($validated);

        return new RegistroResource($registro);
    }
}
