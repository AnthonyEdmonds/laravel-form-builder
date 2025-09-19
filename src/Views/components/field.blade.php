@props([
    'field',
])

@use(AnthonyEdmonds\LaravelFormBuilder\Enums\InputType)

<div>
    <label for="{{ $field->id }}">
        {{ $field->label }}
        @if($field->optional === true)
            <span>{{ $field->optionalLabel }}</span>
        @endif
    </label>

    @empty($field->hint)
    @else
        <p class="hint">{{ $field->hint }}</p>
    @endisset

    @error($field->name)
        <p class="error">{{ $message }}</p>
    @enderror

    @switch($field->type)
        @case(InputType::Checkbox)
            <x-form-builder::inputs.checkboxes :field="$field" />
            @break

        @case(InputType::Hidden)
            <x-form-builder::inputs.hidden :field="$field" />
            @break

        @case(InputType::Radio)
            <x-form-builder::inputs.radios :field="$field" />
            @break

        @case(InputType::Select)
            <x-form-builder::inputs.select :field="$field" />
            @break

        @case(InputType::TextArea)
            <x-form-builder::inputs.textarea :field="$field" />
            @break

        @default
            <x-form-builder::inputs.input :field="$field" />
    @endswitch
</div>
