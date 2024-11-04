<x-form-builder-ui::form-group
    :hint="$hint"
    :label="$label"
    :name="$name"
>
    @foreach($options as $optionValue => $optionLabel)
        <input
            id="{{ $id }}.{{ $loop->index }}"
            name="{{ $name }}[]"
            type="checkbox"
            value="{{ $optionValue }}"
            @checked(in_array($optionValue, $value, true) === true)
        />

        <label for="{{ $id }}.{{ $loop->index }}">
            {{ $optionLabel }}
        </label>
    @endforeach
</x-form-builder-ui::form-group>
