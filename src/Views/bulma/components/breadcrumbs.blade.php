@props([
    'breadcrumbs',
])

<nav class="breadcrumb" aria-label="breadcrumbs">
    <ul>
        @foreach($breadcrumbs as $label => $link)
            @if(is_integer($label) === true)
                <li class="is-active">
                    <a aria-current="page">
                        {{ $link }}
                    </a>
                </li>
            @else
                <li>
                    <a href="{{ $link }}">{{ $label }}</a>
                </li>
            @endif
        @endforeach
    </ul>
</nav>

