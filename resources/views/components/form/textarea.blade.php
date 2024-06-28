@props(['name','value' => null])
<div class="form-control">
    <x-form.label :name="$name"/>
    <textarea id="{{$name}}" name="{{$name}}" class="form-control my-2">{{ old($name, $value) }}</textarea>
</div>
