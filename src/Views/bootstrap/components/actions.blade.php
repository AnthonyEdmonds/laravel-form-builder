@props([
    'actions' => [],
    'submit' => null,
    'primary' => null,
    'secondary' => null,
    'gap' => null,
])

<div
    class="d-flex flex-wrap align-items-center"
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

            <button type="submit" class="btn btn-primary">
                {{ $submit->label }}
            </button>
        </form>
    @endif

    @foreach($actions as $index => $action)
        <a
            href="{{ $action->link }}"
            @class([
                'btn btn-primary mr-2' => $index === $primary,
                'btn btn-secondary mr-2' => $index === $secondary,
                'mr-2' => $index !== $primary && $index !== $secondary,
            ])
        >
            {{ $action->label }}
        </a>
    @endforeach
</div>
