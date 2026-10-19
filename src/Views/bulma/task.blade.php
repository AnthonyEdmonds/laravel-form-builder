@php
    $layoutName = config('form-builder.layout.name');
    $layoutSection = config('form-builder.layout.section');
@endphp

@if ($layoutName !== null)
    @extends($layoutName)
@endif

@if ($layoutSection !== null)
    @section($layoutSection)
@endif

<div class="column is-full">
    <x-form-builder::breadcrumbs :breadcrumbs="$breadcrumbs" />

    <div class="is-flex" style="justify-content: space-between; flex-wrap: wrap;">
        <h1 class="title mb-3">{{ $title }}</h1>
    </div>
</div>

<div class="column is-full">
    <section>
        <div class="content">
            <x-form-builder::description :description="$description"/>

            @isset($status)
                <span class="{{ $colour }}">
                        {{ $status }}
                    </span>
            @endisset

            <table class="table is-fullwidth">
                <tbody>
                @forelse($questions as $label => $details)
                    <tr>
                        <th>
                            {{ $label }}
                        </th>

                        <td>
                            {{ $details['value'] }}
                        </td>

                        <td class="has-text-right">
                            @isset($details['status'])
                                <span class="{{ $details['colour'] }}">
                                        {{ $details['status'] }}
                                    </span>
                            @endisset

                            @isset($details['actions']['change'])
                                <a
                                    href="{{ $details['actions']['change']['url'] }}"
                                    class="is-underlined ml-3"
                                >
                                    {{ $details['actions']['change']['label'] }}
                                </a>
                            @endisset
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            No questions have been added to this task.
                        </td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="buttons">
                @foreach($actions as $key => $action)
                    <a href="{{ $action->link }}"
                        class="button {{ $key === 'back' ? 'is-primary' : 'is-light'}}">{{ $action->label }}</a>
                @endforeach
            </div>
        </div>
    </section>
</div>

@if ($layoutSection !== null)
    @endsection
@endif
