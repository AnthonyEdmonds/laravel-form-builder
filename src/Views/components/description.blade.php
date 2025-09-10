@props([
    'description',
])

@foreach($description as $line)
    <p>{{ $line }}</p>
@endforeach
