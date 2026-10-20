@props([
    'rows',
    'emptyMessage' => 'No questions have been added to this task.',
])

<table class="table is-fullwidth">
    <tbody>
    @forelse($rows as $label => $details)
        <tr>
            <th>{{ $label }}</th>

            <td>{{ $details['value'] }}</td>

            <td class="has-text-right">
                @isset($details['status'])
                    <span class="{{ $details['colour'] }}">{{ $details['status'] }}</span>
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
            <td colspan="3">{{ $emptyMessage }}</td>
        </tr>
    @endforelse
    </tbody>
</table>
