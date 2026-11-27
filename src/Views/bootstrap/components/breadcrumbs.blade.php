@props([
    'breadcrumbs',
])

<nav aria-label="breadcrumbs">
    <ol class="breadcrumb d-flex flex-row bg-white">
        @foreach($breadcrumbs as $label => $link)
            @if(is_integer($label) === true)
                <li class="breadcrumb-item active" aria-current="page">
                    {{ $link }}
                </li>
            @else
                <li class="breadcrumb-item">
                    <a href="{{ $link }}">{{ $label }}</a>
                </li>
            @endif
        @endforeach
    </ol>
</nav>
