@props([
    'field',
])

<select
    id="{{ $field->id }}"
    name="{{ $field->name }}"
>
    @forelse($field->options as $label => $value)
        <option
            @selected($value === old($field->name, $field->value))
            value="{{ $value }}"
        >{{ $label }}</option>
    @empty
        <option>{{ $field->noOptionsMessage }}</option>
    @endforelse
</select>
