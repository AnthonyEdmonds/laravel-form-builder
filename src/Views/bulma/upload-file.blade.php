<x-form-builder::layout>
    @extends('form-builder::question')

    @section('before-main')
        @yield('description')

        @isset($filesMinimum)
            <p>You must upload at least {{ $filesMinimum }}.</p>
        @endif

        @isset($filesLimit)
            <p>You may upload up to {{ $filesLimit }}.</p>
        @endisset

        @isset($filesCurrent)
            <p>You have uploaded {{ $filesCurrent }}.</p>
        @endisset

        @isset($storeLimit)
            <p class="mb-2">You may upload up to {{ $storeLimit }} worth of files.</p>
            <p class="mb-2">You have uploaded {{ $storeCurrent }} worth of files.</p>
        @endisset

        <hr />

        <table class="table is-fullwidth">
            <caption>Uploaded files</caption>

            <thead>
                <tr>
                    <th>Name</th>
                    <th>Size</th>
                    <th></th>
                    <th></th>
                </tr>
            </thead>

            <tbody>
                @forelse($filesList as $file)
                    <tr>
                        <td>{{ $file['name'] }}</td>
                        <td>{{ $file['size'] }}</td>
                        <td>
                            <form
                                action="{{ $file['remove_url'] }}"
                                method="POST"
                            >
                                @csrf
                                @method('DELETE')
                                <button
                                    class="button is-danger is-small"
                                    type="submit"
                                >Remove</button>
                            </form>
                        </td>
                        <td>
                            <a
                                href="{{ $file['download_url'] }}"
                                class="is-underlined ml-3"
                            >View</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="4">No files have been uploaded yet</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        <hr />
    @endsection
</x-form-builder::layout>
