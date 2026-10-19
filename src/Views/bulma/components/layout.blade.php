@php
    $layoutName = config('form-builder.layout.name');
    $layoutSection = config('form-builder.layout.section');
@endphp

@if ($layoutName)
    @extends($layoutName)
@endif

@if ($layoutSection)
    @section($layoutSection)
@endif

{{ $slot }}

@if ($layoutSection)
    @endsection
@endif
