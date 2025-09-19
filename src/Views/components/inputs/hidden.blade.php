@props([
    'field',
])

<input
    name="{{ $field->name }}"
    type="hidden"
    value="{{ $field->value }}"
/>
