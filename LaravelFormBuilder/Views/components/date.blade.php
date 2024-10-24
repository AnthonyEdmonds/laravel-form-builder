<x-form-builder-ui::form-group
    :hint="$hint"
    :label="$label"
    :name="$name"
>
    <x-form-builder::hidden :id="$id" :name="$name" value="1" />

    @if($noDay !== true)
        <label for="{{ $dayId }}">Day</label>
    
        <input
            autocomplete="{{ $autocompleteDay }}"
            id="{{ $dayId }}"
            inputmode="numeric"
            name="{{ $dayName }}"
            size="3"
            type="text"
            value="{{ $dayValue }}"
        />
    @endif

    @if($noMonth !== true)
        <label for="{{ $monthId }}">Month</label>
    
        <input
            autocomplete="{{ $autocompleteMonth }}"
            id="{{ $monthId }}"
            inputmode="numeric"
            name="{{ $monthName }}"
            size="3"
            type="text"
            value="{{ $monthValue }}"
        />
    @endif

    @if($noYear !== true)
        <label for="{{ $yearId }}">Year</label>
        
        <input
            autocomplete="{{ $autocompleteYear }}"
            id="{{ $yearId }}"
            inputmode="numeric"
            name="{{ $yearName }}"
            size="5"
            type="text"
            value="{{ $yearValue }}"
        />
    @endif
</x-form-builder-ui::form-group>
