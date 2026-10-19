<x-form-builder::layout>

    <div class="column is-full">
        <x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

        <div class="is-flex" style="justify-content: space-between; flex-wrap: wrap;">
            <h1 class="title mb-3">{{ $title }}</h1>
        </div>
    </div>

    <div class="column is-full">
        <div id="content">
            <div class="content">
                <x-form-builder::description :description="$description" />

                <div class="buttons">
                    @foreach($actions as $key => $action)
                        <a href="{{ $action->link }}"
                            class="button {{ $key === 'resume' ? 'is-primary' : 'is-light'}}">{{ $action->label }}</a>
                    @endforeach
                </div>
            </div>
        </div>
    </div>

</x-form-builder::layout>
