<x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

<main>
    <h1>{{ $title }}</h1>

    <x-form-builder::description :description="$description" />

    <form
        action="{{ $save['link'] }}"
        enctype="multipart/form-data"
        method="POST"
    >
        @csrf
        @method('POST')

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

                @isset($field['hint'])
                    <p class="hint">{{ $field['hint'] }}</p>
                @endisset

                @error($key)
                    <p class="error">{{ $message }}</p>
                @enderror

                <input
                    id="{{ $key }}"
                    name="{{ $key }}"
                    value="{{ old($key, $field['answer']) }}"
                />
            </div>
        @empty
            <p>No fields have been added to this question.</p>
        @endforelse

        <button>{{ $save['label'] }}</button>
        @isset($skip)
            <button formaction="{{ $skip['link'] }}">{{ $skip['label'] }}</button>
        @endisset
    </form>

    <x-form-builder::actions :actions="$actions" />
</main>
