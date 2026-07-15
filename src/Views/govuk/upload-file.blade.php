@extends('form-builder::question')

@section('before-main')
    @yield('description')

    @isset($filesMinimum)
        <x-govuk::p>You must upload at least {{ $filesMinimum }}.</x-govuk::p>
    @endif

    @isset($filesLimit)
        <x-govuk::p>You may upload up to {{ $filesLimit }}.</x-govuk::p>
    @endisset

    @isset($filesCurrent)
        <x-govuk::p>You have uploaded {{ $filesCurrent }}.</x-govuk::p>
    @endisset

    @isset($storeLimit)
        <x-govuk::p>You may upload up to {{ $storeLimit }} worth of files.</x-govuk::p>
        <x-govuk::p>You have uploaded {{ $storeCurrent }} worth of files.</x-govuk::p>
    @endisset

    <x-govuk::section-break size="m" />

    <x-govuk::table
        caption="Existing files"
        :data="$filesList"
        empty-message="No files have been uploaded yet"
    >
        <x-govuk::table-column label="Name">
            ~name
        </x-govuk::table-column>

        <x-govuk::table-column label="Size">
            ~size
        </x-govuk::table-column>

        <x-govuk::table-column label="" numeric>
            <x-govuk::form action="~remove_url" method="DELETE">
                <x-govuk::button as-link>Remove</x-govuk::button>
            </x-govuk::form>
        </x-govuk::table-column>

        <x-govuk::table-column label="" numeric>
            <x-govuk::a href="~download_url">View</x-govuk::a>
        </x-govuk::table-column>
    </x-govuk::table>

    <x-govuk::section-break size="m" />
@endsection
