<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            @lang('REGISTRO NUEVA VISITA')
        </h2>
    </x-slot>

    <div class="py-12">





        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <x-partials.card>
                <x-slot name="title">
                    <a href="{{ route('registros.index') }}" class="mr-4"><i
                            class="mr-1 icon ion-md-arrow-back"></i></a>
                </x-slot>


                <div class="alert alert-primary" role="alert">
                    No olvidar marcar salida de visita!
                </div>

                <x-form method="POST" action="{{ route('registros.store') }}" class="mt-4">
                    @include('app.registros.form-inputs')

                    <div class="mt-10">
                        <a href="{{ route('registros.index') }}" class="button">
                            <i class="
                                    mr-1
                                    icon
                                    ion-md-return-left
                                    text-primary
                                "></i>
                            @lang('crud.common.back')
                        </a>

                        <button type="submit" class="button button-primary float-right">
                            <i class="mr-1 icon ion-md-save"></i>
                            @lang('crud.common.create')
                        </button>
                    </div>
                </x-form>
            </x-partials.card>
        </div>
    </div>
</x-app-layout>