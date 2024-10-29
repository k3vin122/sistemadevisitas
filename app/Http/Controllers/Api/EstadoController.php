<?php

namespace App\Http\Controllers\Api;

use App\Models\Estado;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\EstadoResource;
use App\Http\Resources\EstadoCollection;
use App\Http\Requests\EstadoStoreRequest;
use App\Http\Requests\EstadoUpdateRequest;

class EstadoController extends Controller
{
    public function index(Request $request): EstadoCollection
    {
        $this->authorize('view-any', Estado::class);

        $search = $request->get('search', '');

        $estados = Estado::search($search)
            ->latest()
            ->paginate();

        return new EstadoCollection($estados);
    }

    public function store(EstadoStoreRequest $request): EstadoResource
    {
        $this->authorize('create', Estado::class);

        $validated = $request->validated();

        $estado = Estado::create($validated);

        return new EstadoResource($estado);
    }

    public function show(Request $request, Estado $estado): EstadoResource
    {
        $this->authorize('view', $estado);

        return new EstadoResource($estado);
    }

    public function update(
        EstadoUpdateRequest $request,
        Estado $estado
    ): EstadoResource {
        $this->authorize('update', $estado);

        $validated = $request->validated();

        $estado->update($validated);

        return new EstadoResource($estado);
    }

    public function destroy(Request $request, Estado $estado): Response
    {
        $this->authorize('delete', $estado);

        $estado->delete();

        return response()->noContent();
    }
}
