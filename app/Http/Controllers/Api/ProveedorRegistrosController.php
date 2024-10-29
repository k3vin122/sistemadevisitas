<?php

namespace App\Http\Controllers\Api;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegistroResource;
use App\Http\Resources\RegistroCollection;

class ProveedorRegistrosController extends Controller
{
    public function index(
        Request $request,
        Proveedor $proveedor
    ): RegistroCollection {
        $this->authorize('view', $proveedor);

        $search = $request->get('search', '');

        $registros = $proveedor
            ->registros()
            ->search($search)
            ->latest()
            ->paginate();

        return new RegistroCollection($registros);
    }

    public function store(
        Request $request,
        Proveedor $proveedor
    ): RegistroResource {
        $this->authorize('create', Registro::class);

        $validated = $request->validate([
            'rut' => ['required', 'max:255', 'string'],
            'nombres' => ['required', 'max:255', 'string'],
            'apellidos' => ['required', 'max:255', 'string'],
            'motivo' => ['required', 'max:255', 'string'],
            'estado_id' => ['required', 'exists:estados,id'],
            'user_id' => ['required', 'exists:users,id'],
        ]);

        $registro = $proveedor->registros()->create($validated);

        return new RegistroResource($registro);
    }
}
