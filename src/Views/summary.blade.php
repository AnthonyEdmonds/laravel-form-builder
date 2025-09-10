<x-form-builder.breadcrumbs :breadcrumbs="$breadcrumbs" />

<main>
    <h1>{{ $title }}</h1>

    <x-form-builder.description :description="$description" />

    - List of tasks
    - List of questions (link to view task)
    - List of answers (link to change answer)

    <x-form-builder.actions :actions="$actions" />
</main>
