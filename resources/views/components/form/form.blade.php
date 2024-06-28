@props(['method' => 'GET', 'action', 'hasFiles' => false])
@if (ucwords($method) != 'GET')
    @php
        $formMethod = 'POST';
    @endphp
@else
    @php
        $formMethod = 'GET';
    @endphp
@endif
<form action="{{ $action }}" method="{{ $formMethod }}" 
{!! $hasFiles ? 'enctype="multipart/form-data"' : '' !!}>
    @csrf
    @method($method)
    {{ $slot }}
</form>
