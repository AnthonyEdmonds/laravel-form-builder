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
    <x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

    <div class="is-flex" style="justify-content: space-between; flex-wrap: wrap;">
        <h1 class="title mb-3">{{ $title }}</h1>
    </div>
</div>

<div class="column is-full">
    <div class="content">
        <x-form-builder::description :description="$description"/>

        @forelse($tasks as $task)
            @if($task['group'] !== $currentGroup && $task['group'] !== null)
                <h2 class="title is-4 mt-5">
                    {{ $task['group'] }}
                </h2>
            @endif

            <hr class="my-2">

            <div
                id="{{ $task['id'] }}"
                class="is-flex is-justify-content-space-between is-align-items-center py-2"
            >
                <div>
                    @if($task['url'] !== null)
                        <a href="{{ $task['url'] }}">
                            {{ $task['label'] }}
                        </a>
                    @else
                        {{ $task['label'] }}
                    @endif

                    @foreach($task['hint'] as $hint)
                        <p class="has-text-grey mt-1 mb-0">
                            {{ $hint }}
                        </p>
                    @endforeach
                </div>

                <div class="ml-5">
                <span class="{{ $task['colour'] }}">
                    {{ $task['status'] }}
                </span>
                </div>
            </div>

            <hr class="my-2">

            @php
                $currentGroup = $task['group'];
            @endphp
        @empty
            <div class="notification is-light">
                No tasks have been added to this form.
            </div>
        @endforelse

        <div class="buttons">
            @foreach($actions as $key => $action)
                <a href="{{ $action->link }}"
                    class="button {{ $key === 'summary' ? 'is-primary' : 'is-light'}}">{{ $action->label }}</a>
            @endforeach
        </div>
    </div>
</div>

@if ($layoutSection !== null)
    @endsection
@endif
