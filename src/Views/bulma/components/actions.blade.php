@props([
    'actions' => [],
    'submit' => null,
    'primary' => null,
    'secondary' => null,
    'gap' => null,
])

<div
    class="buttons"
    @if($gap) style="gap: {{ $gap }};" @endif
>
    @if($submit !== null)
        <form
            action="{{ $submit->link }}"
            enctype="multipart/form-data"
            method="POST"
            style="margin: 0;"
        >
            @csrf

            <button type="submit" class="button is-primary">
                {{ $submit->label }}
            </button>
        </form>
    @endif

    @foreach($actions as $index => $action)
        <a
            href="{{ $action->link }}"
            @class([
                'button is-primary' => $index === $primary,
                'button' => $index === $secondary,
                'is-underlined' => $index !== $primary && $index !== $secondary,
            ])
        >
            {{ $action->label }}
        </a>
    @endforeach
</div>
