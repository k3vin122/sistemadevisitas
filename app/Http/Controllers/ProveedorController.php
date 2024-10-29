<?php

namespace App\Http\Controllers;

use App\Models\Proveedor;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\ProveedorStoreRequest;
use App\Http\Requests\ProveedorUpdateRequest;

class ProveedorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Proveedor::class);

        $search = $request->get('search', '');

        $proveedors = Proveedor::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.proveedors.index', compact('proveedors', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Proveedor::class);

        return view('app.proveedors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProveedorStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Proveedor::class);

        $validated = $request->validated();

        $proveedor = Proveedor::create($validated);

        return redirect()
            ->route('proveedors.edit', $proveedor)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Proveedor $proveedor): View
    {
        $this->authorize('view', $proveedor);

        return view('app.proveedors.show', compact('proveedor'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Proveedor $proveedor): View
    {
        $this->authorize('update', $proveedor);

        return view('app.proveedors.edit', compact('proveedor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        ProveedorUpdateRequest $request,
        Proveedor $proveedor
    ): RedirectResponse {
        $this->authorize('update', $proveedor);

        $validated = $request->validated();

        $proveedor->update($validated);

        return redirect()
            ->route('proveedors.edit', $proveedor)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Proveedor $proveedor
    ): RedirectResponse {
        $this->authorize('delete', $proveedor);

        $proveedor->delete();

        return redirect()
            ->route('proveedors.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
