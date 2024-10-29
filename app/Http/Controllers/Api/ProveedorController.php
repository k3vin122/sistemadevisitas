<?php

namespace App\Http\Controllers\Api;

use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProveedorResource;
use App\Http\Resources\ProveedorCollection;
use App\Http\Requests\ProveedorStoreRequest;
use App\Http\Requests\ProveedorUpdateRequest;

class ProveedorController extends Controller
{
    public function index(Request $request): ProveedorCollection
    {
        $this->authorize('view-any', Proveedor::class);

        $search = $request->get('search', '');

        $proveedors = Proveedor::search($search)
            ->latest()
            ->paginate();

        return new ProveedorCollection($proveedors);
    }

    public function store(ProveedorStoreRequest $request): ProveedorResource
    {
        $this->authorize('create', Proveedor::class);

        $validated = $request->validated();

        $proveedor = Proveedor::create($validated);

        return new ProveedorResource($proveedor);
    }

    public function show(
        Request $request,
        Proveedor $proveedor
    ): ProveedorResource {
        $this->authorize('view', $proveedor);

        return new ProveedorResource($proveedor);
    }

    public function update(
        ProveedorUpdateRequest $request,
        Proveedor $proveedor
    ): ProveedorResource {
        $this->authorize('update', $proveedor);

        $validated = $request->validated();

        $proveedor->update($validated);

        return new ProveedorResource($proveedor);
    }

    public function destroy(Request $request, Proveedor $proveedor): Response
    {
        $this->authorize('delete', $proveedor);

        $proveedor->delete();

        return response()->noContent();
    }
}
