<x-form-builder-ui::form-group
    :hint="$hint"
    :label="$label"
    :name="$name"
>
    @foreach($options as $optionValue => $optionLabel)
        <input
            @checked($optionValue === $value)
            id="{{ $id }}.{{ $loop->index }}"
            name="{{ $name }}"
            type="radio"
            value="{{ $value }}"
        />

        <label for="{{ $id }}.{{ $loop->index }}">
            {{ $optionLabel }}
        </label>
    @endforeach
</x-form-builder-ui::form-group>
