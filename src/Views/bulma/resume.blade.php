@php
    $layoutName = config('form-builder.layout.name');
    $layoutSection = config('form-builder.layout.section');
@endphp

@if ($layoutName !== null)
    @extends($layoutName)
@endif

@if ($layoutSection !== null)
    @section($layoutSection)
@endif

<div class="column is-full">
    {{ Breadcrumbs::render('support-detail.resume') }}
    <div class="is-flex" style="justify-content: space-between; flex-wrap: wrap;">
        <h1 class="title mb-3">{{ $title }}</h1>
    </div>
</div>

<div class="column is-full">
    <div id="content">
        <div class="content">
            <x-form-builder::description :description="$description"/>

            <div class="buttons">
                @foreach($actions as $key => $action)
                    <a href="{{ $action->link }}"
                        class="button {{ $key === 'resume' ? 'is-primary' : 'is-light'}}">{{ $action->label }}</a>
                @endforeach
            </div>
        </div>
    </div>

@if ($layoutSection !== null)
    @endsection
@endif
