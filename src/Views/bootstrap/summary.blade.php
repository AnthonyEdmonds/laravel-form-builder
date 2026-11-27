@use(AnthonyEdmonds\LaravelFormBuilder\Enums\Colour)

<x-form-builder::layout>
    <div class="col-12">
        <x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

        <div class="d-flex justify-content-between flex-wrap">
            <h2 class="title mb-4 font-weight-bold">{{ $title }}</h2>
        </div>
    </div>

    <div class="col-12">
        <section>
            @if($errors->any())
                <div class="border border-danger border-5 p-3 mb-4">
                    <h2 class="h3">There is a problem</h2>

                    @foreach($errors->all() as $error)
                        <p class="text-danger font-weight-bold">
                            {{ $error }}
                        </p>
                    @endforeach
                </div>
            @endif

            <x-form-builder::description :description="$description" />

            @forelse($summary as $task)
                <div class="mb-5">
                    <div class="d-flex justify-content-between align-items-center bg-light p-3">
                        <h2
                            id="{{ $task['id'] }}"
                            class="h5 font-weight-bold mb-0"
                        >
                            {{ $task['title'] }}
                        </h2>

                        <div
                            class="d-flex align-items-center"
                            style="gap: 0.75rem;"
                        >
                            <span class="badge {{ Colour::tryFrom($task['colour'])?->toBootstrapClass() ?? 'alert-secondary' }} px-3 py-2">
                                {{ $task['status'] }}
                            </span>

                            @isset($task['actions']['change'])
                                <a
                                    href="{{ $task['actions']['change']['url'] }}"
                                    class="font-weight-bold text-decoration-underline"
                                >
                                    {{ $task['actions']['change']['label'] }}
                                </a>
                            @endisset
                        </div>
                    </div>

                    <x-form-builder::summary-table :rows="$task['list']" />
                </div>
            @empty
                <p>No tasks have been added to this form.</p>
            @endforelse

            <form
                action="{{ $submit->link }}"
                enctype="multipart/form-data"
                method="POST"
            >
                @csrf
                @method('POST')

                <x-form-builder::actions
                    :actions="$actions"
                    :submit="$submit"
                    gap="1rem"
                />
            </form>
        </section>
    </div>
</x-form-builder::layout>
