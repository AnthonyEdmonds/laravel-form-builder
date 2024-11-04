<x-form-builder-ui::form-group
    :hint="$hint"
    :label="$label"
    :name="$name"
>
    <input
        autocomplete="{{ $autocomplete }}"
        id="{{ $id }}"
        inputmode="{{ $inputmode }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        size="{{ $size }}"
        spellcheck="{{ $spellcheck }}"
        type="{{ $type }}"
        value="{{ $value }}"
    />
</x-form-builder-ui::form-group>
