<?php

namespace App\Http\Controllers\Api;

use App\Models\Registro;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\RegistroResource;
use App\Http\Resources\RegistroCollection;
use App\Http\Requests\RegistroStoreRequest;
use App\Http\Requests\RegistroUpdateRequest;

class RegistroController extends Controller
{
    public function index(Request $request): RegistroCollection
    {
        $this->authorize('view-any', Registro::class);

        $search = $request->get('search', '');

        $registros = Registro::search($search)
            ->latest()
            ->paginate();

        return new RegistroCollection($registros);
    }

    public function store(RegistroStoreRequest $request): RegistroResource
    {
        $this->authorize('create', Registro::class);

        $validated = $request->validated();

        $registro = Registro::create($validated);

        return new RegistroResource($registro);
    }

    public function show(Request $request, Registro $registro): RegistroResource
    {
        $this->authorize('view', $registro);

        return new RegistroResource($registro);
    }

    public function update(
        RegistroUpdateRequest $request,
        Registro $registro
    ): RegistroResource {
        $this->authorize('update', $registro);

        $validated = $request->validated();

        $registro->update($validated);

        return new RegistroResource($registro);
    }

    public function destroy(Request $request, Registro $registro): Response
    {
        $this->authorize('delete', $registro);

        $registro->delete();

        return response()->noContent();
    }
}
