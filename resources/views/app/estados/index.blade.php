<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('Lista de estados vista Sala de servidores')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <div class="mb-5 mt-4">
                    <div class="flex flex-wrap justify-between">
                        <div class="md:w-1/2">

                        </div>
                        <div class="md:w-1/2 text-right">
                            @can('create', App\Models\Estado::class)
                            <a href="{{ route('estados.create') }}" class="button button-primary">
                                <i class="mr-1 icon ion-md-add"></i>
                                @lang('crud.common.create')
                            </a>
                            @endcan
                        </div>
                    </div>
                </div>

                <div class="block w-full overflow-auto scrolling-touch">
                    <table id="miTabla" class="table table-striped" style="width:50%">
                        <thead class="text-gray-700">
                            <tr>
                                <th class="px-4 py-3 text-left">
                                    @lang('crud.estados.inputs.nombre_estado')
                                </th>

                                <th></th>
                            </tr>
                        </thead>
                        <tbody class="text-gray-600">
                            @forelse($estados as $estado)
                            <tr class="hover:bg-gray-50">
                                <td class="px-4 py-3 text-left">
                                    {{ $estado->nombre_estado ?? '-' }}
                                </td>

                                <td class="px-4 py-3 text-center" style="width: 134px;">
                                    <div role="group" aria-label="Row Actions" class="
                                            relative
                                            inline-flex
                                            align-middle
                                        ">
                                        @can('update', $estado)
                                        <a href="{{ route('estados.edit', $estado) }}" class="mr-1">
                                        <button type="button" class="button">
                                                <i class="fa-solid fa-pen-to-square fa-xl" style="color: #B197FC;"></i>
                                            </button>
                                        </a>
                                        @endcan @can('view', $estado)

                                        @endcan @can('delete', $estado)
                                        <form action="{{ route('estados.destroy', $estado) }}" method="POST"
                                            onsubmit="return confirm('{{ __('crud.common.are_you_sure') }}')">
                                            @csrf @method('DELETE')
                                            <button type="submit" class="button">
                                                <i class="fa-solid fa-calendar-xmark fa-xl" style="color: #eb0f0f;"></i>
                                            </button>
                                        </form>
                                        @endcan
                                    </div>
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="2">
                                    @lang('crud.common.no_items_found')
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                        <tfoot>
                            <tr>
                                <td colspan="2">
                                    <div class="mt-10 px-4">
                                        {!! $estados->render() !!}
                                    </div>
                                </td>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>