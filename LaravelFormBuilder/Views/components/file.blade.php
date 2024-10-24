<x-form-builder-ui::form-group
    :hint="$hint"
    :label="$label"
    :name="$name"
>
    <input
        accept="{{ $accept }}"
        id="{{ $id }}"
        name="{{ $name }}"
        type="file"
    />
</x-form-builder-ui::form-group>
