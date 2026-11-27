@use(AnthonyEdmonds\LaravelFormBuilder\Enums\Colour)

@php
    $currentGroup = null;
@endphp

<x-form-builder::layout>
    <div class="col-12">
        <x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

        <div class="d-flex justify-content-between flex-wrap" style="justify-content: space-between; flex-wrap: wrap;">
            <h2 class="title mb-4 font-weight-bold">{{ $title }}</h2>
        </div>
    </div>

    <div class="col12l">
        <div class="content">
            <x-form-builder::description :description="$description" />

            @forelse($tasks as $task)
                @if($task['group'] !== $currentGroup && $task['group'] !== null)
                    <h2 class="title h4 mt-5">{{ $task['group'] }}</h2>
                @endif

                <hr class="my-2" />

                <div
                    id="{{ $task['id'] }}"
                    class="d-flex justify-content-between align-items-center py-2"
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
                            <p class="text-muted mt-1 mb-0">{{ $hint }}</p>
                        @endforeach
                    </div>

                    <div class="ml-5">
                        <span class="badge {{ Colour::tryFrom($task['colour'])->toBootstrapClass() ?? 'badge-secondary' }} px-3 py-2">
                            {{ $task['status'] }}
                        </span>
                    </div>
                </div>

                <hr class="my-2" />

                @php
                    $currentGroup = $task['group'];
                @endphp
            @empty
                <div class="alert alert-light">
                    No tasks have been added to this form.
                </div>
            @endforelse

            <x-form-builder::actions
                :actions="$actions"
                primary="summary"
                gap="1rem"
            />
        </div>
    </div>
</x-form-builder::layout>
