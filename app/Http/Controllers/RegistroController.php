<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Estado;
use App\Models\Registro;
use Illuminate\View\View;
use App\Models\Proveedor;
use Illuminate\Http\Request;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\RegistroStoreRequest;
use App\Http\Requests\RegistroUpdateRequest;

class RegistroController extends Controller
{



    public function duplicar($id)
    {
        $original = Registro::find($id);

        // Verificar si ya ha sido duplicado
        if ($original->duplicated) {

            return redirect()->route('registros.index')->with('var_mensaje', 'NO SE PUEDE REGISTRA SALIDA');

        }
        
        // Crear una nueva instancia y copiar los atributos
        $duplicate = $original->replicate();
        $duplicate->estado_id = '2'; // Cambia el estado a 'inactivo' o cualquier otro valor que desees
        $duplicate->created_at = now();

        
        // Guardar el nuevo registro
        $duplicate->save();
        
        // Marcar el original como duplicado
        $original->duplicated = true;
        $original->save();
        
        return redirect()->route('registros.index')->with('var_salida', 'SE REGISTRO SALIDA');
    }

    /**
     * Display a listing of the resource.
     */
    public function index(Request $request): View
    {
         $timestamps = true;
        $this->authorize('view-any', Registro::class);

        $search = $request->get('search', '');

        $registros = Registro::search($search)
            ->latest()
            ->paginate()
            ->withQueryString();

        return view('app.registros.index', compact('registros', 'search'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request): View
    {
        $this->authorize('create', Registro::class);

        $proveedors = Proveedor::pluck('nombre', 'id');
        $estados = Estado::pluck('nombre_estado', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.registros.create',
            compact('proveedors', 'estados', 'users')
        );
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(RegistroStoreRequest $request): RedirectResponse
    {
        $this->authorize('create', Registro::class);

        $validated = $request->validated();

        $registro = Registro::create($validated);

        return redirect()
            ->route('registros.edit', $registro)
            ->withSuccess(__('crud.common.created'));
    }

    /**
     * Display the specified resource.
     */
    public function show(Request $request, Registro $registro): View
    {
        $this->authorize('view', $registro);

        return view('app.registros.show', compact('registro'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Request $request, Registro $registro): View
    {
        $this->authorize('update', $registro);

        $proveedors = Proveedor::pluck('nombre', 'id');
        $estados = Estado::pluck('nombre_estado', 'id');
        $users = User::pluck('name', 'id');

        return view(
            'app.registros.edit',
            compact('registro', 'proveedors', 'estados', 'users')
        );
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(
        RegistroUpdateRequest $request,
        Registro $registro
    ): RedirectResponse {
        $this->authorize('update', $registro);

        $validated = $request->validated();

        $registro->update($validated);

        return redirect()
            ->route('registros.edit', $registro)
            ->withSuccess(__('crud.common.saved'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(
        Request $request,
        Registro $registro
    ): RedirectResponse {
        $this->authorize('delete', $registro);

        $registro->delete();

        return redirect()
            ->route('registros.index')
            ->withSuccess(__('crud.common.removed'));
    }
}