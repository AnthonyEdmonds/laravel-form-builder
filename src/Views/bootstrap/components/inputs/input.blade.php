@props([
    'field',
])

<input
    class="form-control @error($field->name) is-danger @enderror"
    id="{{ $field->id }}"
    max="{{ $field->max }}"
    min="{{ $field->min }}"
    name="{{ $field->name }}"
    type="{{ $field->type }}"
    value="{{ old($field->name, $field->value) }}"
/>
