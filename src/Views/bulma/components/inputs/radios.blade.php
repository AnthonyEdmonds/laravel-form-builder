@props([
    'field',
])

@php
    $selected = old($field->name);

    if (empty($selected) === true) {
        $savedValue = $field->value ?? null;

        if (
            empty($savedValue) === false
            && array_key_exists($savedValue, $field->options)
        ) {
            $selected = $savedValue;
        }
    }

    if (empty($selected) === true) {
        foreach ($field->options as $value => $option) {
            if (is_array($option) === false) {
                continue;
            }

            if (empty($option['inputs']) === true) {
                continue;
            }

            foreach ($option['inputs'] as $input) {
                 $inputValue = $input['value'] ?? null;

                 if (empty($inputValue) === false) {
                     $selected = $value;
                     break 2;
                 }
            }
        }
    }
@endphp

@forelse($field->options as $value => $option)
    @if(is_array($option) && ($option['divider'] ?? false) === true)
        <p class="my-3">
            {{ $option['label'] }}
        </p>

        @continue
    @endif

    @php
        if (is_array($option) === true) {
            $label = $option['label'];
            $inputs = $option['inputs'] ?? [];
        } else {
            $label = $option;
            $inputs = [];
        }
    @endphp

    <div class="mb-3">
        <label
            class="radio"
            for="{{ $field->id }}-{{ $loop->index }}"
        >
            <input
                id="{{ $field->id }}-{{ $loop->index }}"
                name="{{ $field->name }}"
                type="radio"
                value="{{ $value }}"
                @checked($selected === $value)
                onchange="
                    document
                        .querySelectorAll('[data-radio-group=\'{{ $field->name }}\']')
                        .forEach(el => el.classList.add('is-hidden'));
                    document
                        .getElementById('{{ $field->id }}-inputs-{{ $loop->index }}')
                        ?.classList.remove('is-hidden');
            "/>
            {{ $label }}
        </label>

        @if(count($inputs) > 0)
            <div
                id="{{ $field->id }}-inputs-{{ $loop->index }}"
                data-radio-group="{{ $field->name }}"
                class="ml-5 mt-3 {{ $selected !== $value ? 'is-hidden' : '' }}"
            >
                @foreach($inputs as $index => $input)
                    @php
                        $inputType = $input['type'] ?? 'input';

                        $inputField = (object) [
                            'id' => $field->id . '-' . $value . '-' . $index,
                            'name' => $input['name'],
                            'value' => $input['value'] ?? null,
                            'options' => $input['options'] ?? [],
                            'type' => $input['type'] ?? 'text',
                            'max' => $input['max'] ?? '',
                            'min' => $input['min'] ?? '',
                            'noOptionsMessage' => 'No options available',
                        ];
                    @endphp

                    <div class="field">
                        @if(empty($input['label']) === false)
                            <label
                                for="{{ $field->id }}-{{ $value }}-{{ $index }}"
                                class="label"
                            >{{ $input['label'] }}</label>
                        @endif

                        @if(empty($input['hint']) === false)
                            <p class="help">{{ $input['hint'] }}</p>
                        @endif

                        @error($input['name'])
                            <p class="help is-danger">{{ $message }}</p>
                        @enderror
                        <div class="control">
                            @if($inputType === 'select')
                                <x-form-builder::inputs.select :field="$inputField"/>
                            @else
                                <x-form-builder::inputs.input :field="$inputField"/>
                            @endif
                        </div>
                    </div>
                @endforeach
            </div>
        @endif
    </div>
    @empty
    <p class="help">
        {{ $field->noOptionsMessage }}
    </p>
@endforelse
