<x-form-builder::layout>
    <div class="col-12">
        <x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

        <div class="d-flex justify-content-between flex-wrap" style="justify-content: space-between; flex-wrap: wrap;">
            <h2 class="title mb-4 font-weight-bold">{{ $title }}</h2>
        </div>
    </div>

    <div class="col-12">
        <section>
            <div id="content">
                <form
                    action="{{ $save->link }}"
                    enctype="multipart/form-data"
                    method="POST"
                >
                    @csrf

                    @yield('before-fields')

                    @forelse($fields as $field)
                        <x-form-builder::field :field="$field" />
                    @empty
                        <div class="alert alert-warning">
                            No fields have been added to this question.
                        </div>
                    @endforelse

                    @yield('after-fields')

                    <x-form-builder::actions
                        :actions="$actions"
                        :submit="$save"
                        gap="1rem"
                    />
                </form>
            </div>
        </section>
    </div>
</x-form-builder::layout>
