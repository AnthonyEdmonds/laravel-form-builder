<x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs"/>

<main>
    <h1>{{ $title }}</h1>

    <x-form-builder::description :description="$description"/>

    @forelse($summary as $task)
        <h2>
            {{ $task['title'] }}
            <a href="{{ $task['actions']['change']['url'] }}">{{ $task['actions']['change']['label'] }}</a>
            <span class="{{ $task['colour'] }}">{{ $task['status'] }}</span>
        </h2>

        <ul>
            @forelse($task['list'] as $label => $details)
                <li>
                    <b>{{ $label }}</b>
                    {{ $details['value'] }}
                    <a href="{{ $details['action']['change']['url'] }}">{{ $details['action']['change']['label'] }}</a>
                </li>
            @empty
                <li>No questions have been added to this task.</li>
            @endforelse
        </ul>
    @empty
        <p>No tasks have been added to this form.</p>
    @endforelse

    <form
        action="{{ $submit->link }}"
        enctype="multipart/form-data"
        method="POST"
    >
        @csrf
        @method('POST')

        <button>{{ $submit->label }}</button>
        @isset($draft)
            <button formaction="{{ $draft->link }}">{{ $draft->label }}</button>
        @endisset
    </form>

    <x-form-builder::actions :actions="$actions"/>
</main>
