@props(['name', 'type' => 'text'])
<div class="form-control">
    <x-form.label :name="$name"/>
    <input type="{{ $type }}" id="{{ $name }}" name="{{ $name }}" class="form-control" />
</div>
