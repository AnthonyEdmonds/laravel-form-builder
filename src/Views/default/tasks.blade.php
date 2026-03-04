@php
    $currentGroup = null;
@endphp

<x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

<main>
    <h1>{{ $title }}</h1>

    <x-form-builder::description :description="$description" />

    <ul>
        @forelse($tasks as $task)
            @if($task['group'] !== $currentGroup)
                <li>
                    <h2>{{ $task['group'] }}</h2>
                </li>
            @endif

            <li id="{{ $task['id'] }}">
                @if($task['url'] !== null)
                    <a href="{{ $task['url'] }}">{{ $task['label'] }}</a>
                @else
                    {{ $task['label'] }}
                @endif

                @foreach($task['hint'] as $hint)
                    <p>{{ $hint }}</p>
                @endforeach

                <span class="{{ $task['colour'] }}">{{ $task['status'] }}</span>
            </li>

            @php
                $currentGroup = $task['group'];
            @endphp
        @empty
            <li>No tasks have been added to this form.</li>
        @endforelse
    </ul>

    @isset($draft)
        <form
            action="{{ $draft->link }}"
            enctype="multipart/form-data"
            method="POST"
        >
            @csrf
            @method('POST')

            <button>{{ $draft->label }}</button>
        </form>
    @endisset

    <x-form-builder::actions :actions="$actions" />
</main>

