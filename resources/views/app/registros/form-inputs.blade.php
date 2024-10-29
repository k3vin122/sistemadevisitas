@php $editing = isset($registro) @endphp

<div class="flex flex-wrap">
    <x-inputs.group class="w-full lg:w-3/12">
        <x-inputs.text
            name="rut"
            label="RUT"
            :value="old('rut', ($editing ? $registro->rut : ''))"
            maxlength="255"
            placeholder="Rut"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-5/12">
        <x-inputs.text
            name="nombres"
            label="NOMBRES"
            :value="old('nombres', ($editing ? $registro->nombres : ''))"
            maxlength="255"
            placeholder="Nombres"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-5/12">
        <x-inputs.text
            name="apellidos"
            label="APELLIDOS"
            :value="old('apellidos', ($editing ? $registro->apellidos : ''))"
            maxlength="255"
            placeholder="Apellidos"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-5/12">
        <x-inputs.select name="proveedor_id" label="PROVEEDOR" required>
            @php $selected = old('proveedor_id', ($editing ? $registro->proveedor_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>SELECT...</option>
            @foreach($proveedors as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-5/12">
        <x-inputs.text
            name="motivo"
            label="MOTIVO"
            :value="old('motivo', ($editing ? $registro->motivo : ''))"
            maxlength="255"
            placeholder="Ingrese motivo de la visita al centro de datos"
            required
        ></x-inputs.text>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-5/12">
        <x-inputs.select name="estado_id" label="ESTADO" required>
            @php $selected = old('estado_id', ($editing ? $registro->estado_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>SELECT...</option>
            @foreach($estados as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>

    <x-inputs.group class="w-full lg:w-5/12">
        <x-inputs.select name="user_id" label="FUNCIONARIO ENCARGADO" required>
            @php $selected = old('user_id', ($editing ? $registro->user_id : '')) @endphp
            <option disabled {{ empty($selected) ? 'selected' : '' }}>SELECT...</option>
            @foreach($users as $value => $label)
            <option value="{{ $value }}" {{ $selected == $value ? 'selected' : '' }} >{{ $label }}</option>
            @endforeach
        </x-inputs.select>
    </x-inputs.group>
</div>
