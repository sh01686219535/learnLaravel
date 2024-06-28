@props(['name', 'type' => 'text','value' => null])
<div class="form-control">
    <x-form.label :name="$name"/>
    <input type="{{ $type }}" id="{{ $name }}" value="{{ old($name, $value) }}" name="{{ $name }}" class="form-control" />
</div>
