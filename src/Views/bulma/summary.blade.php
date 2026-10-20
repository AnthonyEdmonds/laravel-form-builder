<x-form-builder::layout>
    <div class="column is-full">
        <x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

        <div class="is-flex" style="justify-content: space-between; flex-wrap: wrap;">
            <h1 class="title mb-3">{{ $title }}</h1>
        </div>
    </div>

    <div class="column is-full">
        <section>
            <div class="content">
                @if($errors->any() === true)
                    <div class="box" style="border: 5px solid #d4351c; border-radius: 0;">
                        <h2 class="title is-3">There is a problem</h2>

                        @foreach($errors->all() as $error)
                            <p class="has-text-danger has-text-weight-bold">
                                {{ $error }}
                            </p>
                        @endforeach
                    </div>
                @endif

                <x-form-builder::description :description="$description" />

                @forelse($summary as $task)
                    <div class="mb-5">
                        <div class="is-flex is-justify-content-space-between is-align-items-center has-background-light p-3">

                            <h2 id="{{ $task['id'] }}" class="is-size-5 has-text-weight-semibold mb-0">
                                {{ $task['title'] }}
                            </h2>

                            <div class="is-flex is-align-items-center" style="gap: 0.75rem;">
                                <span class="{{ $task['colour'] }}">
                                    {{ $task['status'] }}
                                </span>

                                @isset($task['actions']['change'])
                                    <a
                                        href="{{ $task['actions']['change']['url'] }}"
                                        class="has-text-weight-semibold is-underlined"
                                    >
                                        {{ $task['actions']['change']['label'] }}
                                    </a>
                                @endisset
                            </div>
                        </div>

                        @php
                            $rows = collect($task['list'])
                                ->map(function ($details) use ($task) {
                                    $details['status'] = $task['status'] ?? null;
                                    $details['colour'] = $task['colour'] ?? null;

                                    return $details;
                                });
                        @endphp

                        <x-form-builder::summary-table :rows="$rows" />
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

                    <div class="buttons">
                        <button class="button is-primary">{{ $submit->label }}</button>

                        @foreach($actions as $key => $action)
                            <a href="{{ $action->link }}" class="button is-light">{{ $action->label }}</a>
                        @endforeach
                    </div>
                </form>
            </div>
        </section>
    </div>
</x-form-builder::layout>
