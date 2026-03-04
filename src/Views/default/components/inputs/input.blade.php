@props([
    'field',
])

<input
    id="{{ $field->id }}"
    max="{{ $field->max }}"
    min="{{ $field->min }}"
    name="{{ $field->name }}"
    step="{{ $field->step }}"
    type="{{ $field->type }}"
    value="{{ old($field->name, $field->value) }}"
/>
