@php
    $layoutName = config('form-builder.layout.name');
    $layoutSection = config('form-builder.layout.section');
@endphp

@if($layoutName !== null)
    @extends($layoutName)
@endif

@if($layoutSection !== null)
    @section($layoutSection)
@endif

{{ $slot }}

@if($layoutSection !== null)
    @endsection
@endif
