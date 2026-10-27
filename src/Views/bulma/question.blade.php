<x-form-builder::layout>
    <div class="column is-full">
        <x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

        <div class="is-flex" style="justify-content: space-between; flex-wrap: wrap;">
            <h1 class="title mb-3">{{ $title }}</h1>
        </div>
    </div>

    <div class="column is-full">
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
                        <div class="notification is-warning is-light">
                            No fields have been added to this question.
                        </div>
                    @endforelse

                    @yield('after-fields')

                    <x-support-page::actions
                        :actions="$actions"
                        :submit="$save"
                        gap="1rem"
                    />
                </form>
            </div>
        </section>
    </div>
</x-form-builder::layout>
