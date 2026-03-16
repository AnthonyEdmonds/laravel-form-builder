<x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

<main>
    @if($hideTitle === false)
        <h1>{{ $title }}</h1>

        <x-form-builder::description :description="$description" />
    @endif

    <form
        action="{{ $save->link }}"
        enctype="multipart/form-data"
        method="POST"
    >
        @csrf
        @method('POST')

        @yield('before-fields')
        @forelse($fields as $field)
            <x-form-builder::field :field="$field" />
        @empty
            <p>No fields have been added to this question.</p>
        @endforelse
        @yield('after-fields')

        <button>{{ $save->label }}</button>
        @isset($skip)
            <button formaction="{{ $skip->link }}">{{ $skip->label }}</button>
        @endisset
    </form>

    <x-form-builder::actions :actions="$actions" />
</main>
