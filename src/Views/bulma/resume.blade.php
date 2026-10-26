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

                <x-support-page::actions
                    :actions="$actions"
                    primary="resume"
                    secondary="restart"
                />
            </div>
        </div>
    </div>
</x-form-builder::layout>
