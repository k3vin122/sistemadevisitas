@php $editing = isset($estado) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-4/12">
        <x-inputs.text
            name="nombre_estado"
            label="Estado"
            :value="old('nombre_estado', ($editing ? $estado->nombre_estado : ''))"
            maxlength="255"
            placeholder="Nombre de estado"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
