<x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

<main>
    <h1>{{ $title }}</h1>

    <x-form-builder::description :description="$description" />

    @forelse($fields as $key => $field)
        <div>
            <label for="{{ $key }}">
                {{ $field['label'] }}
                @isset($field['optional'])
                    @if($field['optional'] === true)
                        <span>(optional)</span>
                    @endif
                @endisset
            </label>

            <input
                id="{{ $key }}"
                name="{{ $key }}"
                value="{{ old($key, $field['answer']) }}"
            />

            @isset($field['hint'])
                <p class="hint">{{ $field['hint'] }}</p>
            @endisset
        </div>
    @empty
        <p>No fields have been added to this question.</p>
    @endforelse

    <x-form-builder::actions :actions="$actions" />
</main>
