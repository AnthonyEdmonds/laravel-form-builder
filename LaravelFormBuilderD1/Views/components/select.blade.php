<x-form-builder-ui::form-group
    :hint="$hint"
    :label="$label"
    :name="$name"
>
    <select
        autocomplete="{{ $autocomplete }}"
        id="{{ $id }}"
        name="{{ $name }}"
    >
        <option value="">Select an option...</option>
    
        @foreach($options as $key => $label)
            <option
                @selected($key == $value)
                value="{{ $key }}"
            >{{ $label }}</option>
        @endforeach
    </select>
</x-form-builder-ui::form-group>
