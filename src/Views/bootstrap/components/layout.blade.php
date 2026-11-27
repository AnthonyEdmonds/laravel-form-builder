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
<div class="card">
    <div class="card-body px-5 py-4">
        {{ $slot }}
    </div>
</div>


@if($layoutSection !== null)
    @endsection
@endif
