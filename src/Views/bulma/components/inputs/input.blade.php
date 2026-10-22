@props([
    'field',
])

<input
    class="input"
    id="{{ $field->id }}"
    max="{{ $field->max }}"
    min="{{ $field->min }}"
    name="{{ $field->name }}"
    type="{{ $field->type }}"
    value="{{ old($field->name, $field->value) }}"
/>
