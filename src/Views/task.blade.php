<x-form-builder.breadcrumbs :breadcrumbs="$breadcrumbs" />

<main>
    <h1>{{ $title }}</h1>

    <x-form-builder.description :description="$description" />

    <ul>
        @forelse($questions as $question)
            <li>
                <a href="{{ $question['link'] }}">{{ $question['label'] }}</a>
                <span>{{ $question['answer'] }}</span>
            </li>
        @empty
            <li>No questions have been added to this task.</li>
        @endforelse
    </ul>

    <x-form-builder.actions :actions="$actions" />
</main>
