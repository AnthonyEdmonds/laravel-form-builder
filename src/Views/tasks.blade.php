<x-form-builder.breadcrumbs :breadcrumbs="$breadcrumbs" />

<main>
    <h1>{{ $title }}</h1>

    <x-form-builder.description :description="$description" />

    <ul>
        @forelse($tasks as $task)
            <li>
                <a href="{{ $task['link'] }}">{{ $task['label'] }}</a>
                <span class="{{ $task['colour'] }}">{{ $task['status'] }}</span>
            </li>
        @empty
            <li>No tasks have been added to this form.</li>
        @endforelse
    </ul>

    <x-form-builder.actions :actions="$actions" />
</main>
