<?php

namespace App\Http\Controllers\Api;

use App\Models\Estado;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegistroResource;
use App\Http\Resources\RegistroCollection;

class EstadoRegistrosController extends Controller
{
    public function index(Request $request, Estado $estado): RegistroCollection
    {
        $this->authorize('view', $estado);

        $search = $request->get('search', '');

        $registros = $estado
            ->registros()
            ->search($search)
            ->latest()
            ->paginate();

        return new RegistroCollection($registros);
    }

    public function store(Request $request, Estado $estado): RegistroResource
    {
        $this->authorize('create', Registro::class);

        $validated = $request->validate([
            'rut' => ['required', 'max:255', 'string'],
            'nombres' => ['required', 'max:255', 'string'],
            'apellidos' => ['required', 'max:255', 'string'],
            'proveedor_id' => ['required', 'exists:proveedors,id'],
            'motivo' => ['required', 'max:255', 'string'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $registro = $estado->registros()->create($validated);

        return new RegistroResource($registro);
    }
}
