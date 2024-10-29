<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('crud.registros.show_title')
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('registros.index') }}" class="mr-4"
                        ><i class="mr-1 icon ion-md-arrow-back"></i
                    ></a>
                </x-slot>

                <div class="mt-4 px-4">
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registros.inputs.rut')
                        </h5>
                        <span>{{ $registro->rut ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registros.inputs.nombres')
                        </h5>
                        <span>{{ $registro->nombres ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registros.inputs.apellidos')
                        </h5>
                        <span>{{ $registro->apellidos ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registros.inputs.proveedor_id')
                        </h5>
                        <span
                            >{{ optional($registro->proveedor)->nombre ?? '-'
                            }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registros.inputs.motivo')
                        </h5>
                        <span>{{ $registro->motivo ?? '-' }}</span>
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registros.inputs.estado_id')
                        </h5>
                        <span
                            >{{ optional($registro->estado)->nombre_estado ??
                            '-' }}</span
                        >
                    </div>
                    <div class="mb-4">
                        <h5 class="font-medium text-gray-700">
                            @lang('crud.registros.inputs.user_id')
                        </h5>
                        <span
                            >{{ optional($registro->user)->name ?? '-' }}</span
                        >
                    </div>
                </div>

                <div class="mt-10">
                    <a href="{{ route('registros.index') }}" class="button">
                        <i class="mr-1 icon ion-md-return-left"></i>
                        @lang('crud.common.back')
                    </a>

                    @can('create', App\Models\Registro::class)
                    <a href="{{ route('registros.create') }}" class="button">
                        <i class="mr-1 icon ion-md-add"></i>
                        @lang('crud.common.create')
                    </a>
                    @endcan
                </div>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>
