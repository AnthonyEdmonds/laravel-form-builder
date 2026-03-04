@props([
    'breadcrumbs',
])

<nav>
    <ol>
        @foreach($breadcrumbs as $label => $link)
            <li>
                @if(is_integer($label) === true)
                    {{ $link }}
                @else
                    <a href="{{ $link }}">{{ $label }}</a>
                @endif
            </li>
        @endforeach
    </ol>
</nav>
