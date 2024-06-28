@props(['name'])
<label for="{{$name}}">{{ucwords(Str::beforeLast($name, '_'))}}</label>
