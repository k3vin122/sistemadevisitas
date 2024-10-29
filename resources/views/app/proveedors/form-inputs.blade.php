@php $editing = isset($proveedor) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-5/12">
        <x-inputs.text
            name="rut"
            label="Rut"
            :value="old('rut', ($editing ? $proveedor->rut : ''))"
            maxlength="255"
            placeholder="Rut"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-5/12">
        <x-inputs.text
            name="nombre"
            label="Nombre"
            :value="old('nombre', ($editing ? $proveedor->nombre : ''))"
            maxlength="255"
            placeholder="Nombre"
            required
        ></x-inputs.text>
    </x-inputs.group>
</div>
