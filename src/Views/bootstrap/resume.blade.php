<x-form-builder::layout>
    <div class="col-12">
        <x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

        <div class="d-flex justify-content-between flex-wrap">
            <h2 class="mb-4 font-weight-bold">{{ $title }}</h2>
        </div>
    </div>

    <div class="col-12">
        <div id="content">
            <div class="content">
                <x-form-builder::description :description="$description" />

                <x-form-builder::actions
                    :actions="$actions"
                    primary="resume"
                    secondary="restart"
                />
            </div>
        </div>
    </div>
</x-form-builder::layout>
