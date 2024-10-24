<x-form-builder-ui::form-group
    :hint="$hint"
    :label="$label"
    :name="$name"
>
    <textarea
        autocomplete="{{ $autocomplete }}"
        id="{{ $id }}"
        inputmode="{{ $inputmode }}"
        name="{{ $name }}"
        placeholder="{{ $placeholder }}"
        rows="{{ $rows }}"
        spellcheck="{{ $spellcheck === true ? 'true' : 'false' }}"
    >{{ $value }}</textarea>
</x-form-builder-ui::form-group>
