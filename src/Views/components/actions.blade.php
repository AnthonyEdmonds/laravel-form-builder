@props([
    'actions',
])

<ul>
    @foreach($actions as $label => $link)
        <li>
            <a href="{{ $link }}">{{ $label }}</a>
        </li>
    @endforeach
</ul>
