@props([
    'actions',
])

<ul>
    @foreach($actions as $action)
        @if(empty($action->label) === false)
            <li>
                <a href="{{ $action->link }}">{{ $action->label }}</a>
            </li>
        @endif
    @endforeach
</ul>
