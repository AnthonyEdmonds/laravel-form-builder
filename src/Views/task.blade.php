<x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

<main>
    <h1>{{ $title }}</h1>

    <x-form-builder::description :description="$description" />

    <ul>
        @forelse($questions as $label => $details)
            <li>
                <b>{{ $label }}:</b>
                <span>{{ $details['value'] }}</span>
                <a href="{{ $details['action']['url'] }}">{{ $details['action']['label'] }}</a>
            </li>
        @empty
            <li>No questions have been added to this task.</li>
        @endforelse
    </ul>

    <x-form-builder::actions :actions="$actions" />
</main>
