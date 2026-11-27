@use(AnthonyEdmonds\LaravelFormBuilder\Enums\Colour)

<x-form-builder::layout>
    <div class="col-12">
        <x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

        <div class="d-flex justify-content-between flex-wrap" style="justify-content: space-between; flex-wrap: wrap;">
            <h2 class="title mb-4 font-weight-bold">{{ $title }}</h2>
        </div>
    </div>

    <div class="col-12">
        <section>
            @if($errors->any())
                <div class="border border-danger border-5 p-3 mb-4">
                    <h2 class="h3">There is a problem</h2>

                    @foreach($errors->all() as $error)
                        <p class="text-danger fw-bold">
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif
            <div class="content">
                <x-form-builder::description :description="$description" />

                @isset($status)
                    <span class="badge  {{ Colour::tryFrom($colour)->toBootstrapClass() ?? 'badge-secondary' }} px-3 py-2">
                        {{ $status }}
                    </span>
                @endisset

                <x-form-builder::summary-table :rows="$questions" />

                <x-form-builder::actions
                    :actions="$actions"
                    primary="back"
                />
            </div>
        </section>
    </div>
</x-form-builder::layout>
