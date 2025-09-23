@props([
    'actions',
])

<ul>
    @foreach($actions as $action)
        <li>
            <a href="{{ $action->link }}">{{ $action->label }}</a>
        </li>
    @endforeach
</ul>
