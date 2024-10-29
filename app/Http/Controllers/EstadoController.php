<?php

namespace App\Http\Controllers;

use App\Models\Estado;
use Illuminate\View\View;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\EstadoStoreRequest;
use App\Http\Requests\EstadoUpdateRequest;

class EstadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
        $this->authorize('view-any', Estado::class);

        $search = $request->get('search', '');

        $estados = Estado::search($search)
            ->latest()
            ->paginate(5)
            ->withQueryString();

        return view('app.estados.index', compact('estados', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Estado::class);

        return view('app.estados.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(EstadoStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Estado::class);

        $validated = $request->validated();

        $estado = Estado::create($validated);

        return redirect()
            ->route('estados.edit', $estado)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Estado $estado): View
    {
        $this->authorize('view', $estado);

        return view('app.estados.show', compact('estado'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Estado $estado): View
    {
        $this->authorize('update', $estado);

        return view('app.estados.edit', compact('estado'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        EstadoUpdateRequest $request,
        Estado $estado
    ): RedirectResponse {
        $this->authorize('update', $estado);

        $validated = $request->validated();

        $estado->update($validated);

        return redirect()
            ->route('estados.edit', $estado)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request, Estado $estado): RedirectResponse
    {
        $this->authorize('delete', $estado);

        $estado->delete();

        return redirect()
            ->route('estados.index')
            ->withSuccess(__('crud.common.removed'));
    }
}
