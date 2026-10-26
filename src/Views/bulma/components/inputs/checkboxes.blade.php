@props([
    'field',
])

@forelse($field->options as $label => $value)
    <input
        @checked(in_array($value, (array) old($field->name, $field->value)) === true)
        id="{{ $field->id }}-{{ $loop->index }}"
        name="{{ $field->name }}[]"
        type="checkbox"
        value="{{ $value }}"
    />

    <label
        class="checkbox"
        for="{{ $field->id }}-{{ $loop->index }}"
    >{{ $label }}</label>
@empty
    <p>{{ $field->noOptionsMessage }}</p>
@endforelse
