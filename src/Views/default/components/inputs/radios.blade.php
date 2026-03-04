@props([
    'field',
])

@forelse($field->options as $label => $value)
    <input
        @checked($value === old($field->name, $field->value))
        id="{{ $field->id }}-{{ $loop->index }}"
        name="{{ $field->name }}"
        type="radio"
        value="{{ $value }}"
    />

    <label
        for="{{ $option->id }}-{{ $loop->index }}"
    >{{ $label }}</label>
@empty
    <p>{{ $field->noOptionsMessage }}</p>
@endforelse
