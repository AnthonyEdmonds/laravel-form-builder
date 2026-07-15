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
        <p>You may upload up to {{ $storeLimit }} worth of files.</p>
        <p>You have uploaded {{ $storeCurrent }} worth of files.</p>
    @endisset

    <hr />

    <table>
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
                            <button>Remove</button>
                        </form>
                    </td>
                    <td>
                        <a href="{{ $file['download_url'] }}">View</a>
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
