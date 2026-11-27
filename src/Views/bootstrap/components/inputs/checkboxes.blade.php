@props([
    'field',
])

@forelse($field->options as $value => $label)
    <div class="form-check">
        <input
            @checked(in_array($value, (array) old($field->name, $field->value)) === true)
            class="form-check-input"
            id="{{ $field->id }}-{{ $loop->index }}"
            name="{{ $field->name }}[]"
            type="checkbox"
            value="{{ $value }}"
        />

        <label
            class="form-check-label"
            for="{{ $field->id }}-{{ $loop->index }}"
        >
            {{ $label }}
        </label>
    </div>
@empty
    <p class="help">
        {{ $field->noOptionsMessage }}
    </p>
@endforelse
