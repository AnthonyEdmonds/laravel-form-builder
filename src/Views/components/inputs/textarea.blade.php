@props([
    'field',
])

<textarea
    id="{{ $field->id }}"
    name="{{ $field->name }}"
>{{ old($field->name, $field->value) }}</textarea>
