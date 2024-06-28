@props(['name','curd'])
<div class="form-control">
    <x-form.label :name="$name"/>
    <select name="{{$name}}" id="{{$name}}" class="form-control my-2">
        <option value="">Select Curd</option>
        @foreach ($curd as $item)
            <option value="{{ $item->id }}">{{ $item->title }}</option>
        @endforeach
    </select>
</div>