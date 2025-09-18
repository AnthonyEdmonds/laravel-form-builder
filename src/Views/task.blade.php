<x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

<main>
    <h1>{{ $title }}</h1>

    <x-form-builder::description :description="$description" />

    <ul>
        @forelse($questions as $question)
            @foreach($question['fields'] as $key => $field)
                <li>
                    <a href="{{ $question['link'] }}">{{ $question['label'] }}</a>
                    <span>{{ $question['answer'] }}</span>
                </li>
            @endforeach
        @empty
            <li>No questions have been added to this task.</li>
        @endforelse
    </ul>

    <x-form-builder::actions :actions="$actions" />
</main>
