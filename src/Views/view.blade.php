@forelse($summary as $task)
    <h2>{{ $task['title'] }}</h2>

    <ul>
        @forelse($task['list'] as $label => $details)
            <li>
                <b>{{ $label }}</b>
                {{ $details['value'] }}
            </li>
        @empty
            <li>No questions have been added to this task.</li>
        @endforelse
    </ul>
@empty
    <p>No tasks have been added to this form.</p>
@endforelse

<a href="{{ $edit->link }}">{{ $edit->label }}</a>
