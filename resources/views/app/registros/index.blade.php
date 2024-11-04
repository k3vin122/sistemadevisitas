<x-app-layout>
    <div class="fullscreen-div">
        <x-slot name="header">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                @lang('crud.registros.index_title')
            </h2>
        </x-slot>

        @if (session('message'))
        <div class="alert alert-success">
            {{ session('message') }}
        </div>
        @endif



        <div class="block w-full overflow-auto scrolling-touch">
            <br>
            <table id="miTabla">
                <x-partials.card>
                    <div class="container">
                        <div class="center-div">


                            @can('create', App\Models\Registro::class)
                            <a href="{{ route('registros.create') }}" class="button button-primary">
                                <i class="fa-duotone fa-solid fa-pencil fa-bounce">     Nuevo registro </i> @lang('')
                            </a>
                            @endcan
                            @vite(['resources/js/app.js'])

                        </div>
                </x-partials.card>
        </div>
        <br>
        <thead class="text-gray-700">
            <tr>
                <th class="px-4 py-3 text-left">
                    @lang('RUT')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('NOMBRES')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('APELLIDOS')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('PROVEEDOR')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('MOTIVO')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('crud.registros.inputs.estado_id')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('REGISTRO')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('FECHA')
                </th>
                <th class="px-4 py-3 text-left">
                    @lang('HORA')
                </th>

                <th>Acción</th>
            </tr>
        </thead>
        <tbody class="text-gray-600">
            @forelse($registros as $registro)
            <tr class="hover:bg-gray-50">
                <td>
                    {{ $registro->rut ?? '-' }}
                </td>
                <td class="px-4 py-3 text-left">
                    {{ $registro->nombres ?? '-' }}
                </td>
                <td class="px-4 py-3 text-left">
                    {{ $registro->apellidos ?? '-' }}
                </td>
                <td class="px-4 py-3 text-left">
                    {{ optional($registro->proveedor)->nombre ??
                                    '-' }}
                </td>
                <td class="px-4 py-3 text-left">
                    {{ $registro->motivo ?? '-' }}
                </td>
                <td class="px-4 py-3 text-left">
                    {{
                                    optional($registro->estado)->nombre_estado
                                    ?? '-' }}
                </td>
                <td class="px-4 py-3 text-left">
                    {{ optional($registro->user)->name ?? '-' }}
                </td>
                <td class="px-4 py-3 text-left">
                    {{ $registro->created_at->format('F j, Y') ?? '-' }}
                </td>


                <td class="px-4 py-3 text-left">
                    {{ $registro->created_at->format('h:i:s A') ?? '-' }}
                </td>


                <td class="px-4 py-3 text-center" style="width: 134px;">


                    <div role="group" aria-label="Row Actions" class="relative inline-flex align-middle">
                        @can('update', $registro)
                        <a href="{{ route('registros.edit', $registro) }}" class="mr-1">
                            <button type="button" class="button">
                                <i class="fa-solid fa-pen-to-square fa-xl" style="color: #B197FC;"></i>
                            </button>
                        </a>

                        @endcan @can('delete', $registro)
                        <form action="{{ route('registros.destroy', $registro) }}" method="POST"
                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                            @csrf @method('DELETE')

                            <button type="submit" class="button">
                                <i class="fa-solid fa-calendar-xmark fa-xl" style="color: #eb0f0f;"></i>
                            </button>

                        </form>
                        @endcan

                        <form action="{{ route('registros.duplicar', $registro->id) }}" method="POST"
                            style="display:inline;">
                            @csrf
                            <button id="" type="submit" class="button">
                                <i class="fa-solid fa-person-walking-dashed-line-arrow-right fa-xl"
                                    style="color: #FFD43B;"></i> </button>
                        </form>
                    </div>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="8">
                    @lang('crud.common.no_items_found')
                </td>
            </tr>
            @endforelse
        </tbody>
        <tfoot>
            <tr>
                <td colspan="8">

                </td>
            </tr>
        </tfoot>
        </table>





</x-app-layout>