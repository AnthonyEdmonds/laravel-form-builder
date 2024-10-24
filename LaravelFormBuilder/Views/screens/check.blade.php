<h1>Check your answers</h1>

<p>Show a summary of all answers to questions for review.</p>

@foreach($check as $checkable)
    @isset($checkable['title'])
        <h2>{{ $checkable['title'] }}</h2>
    @endisset

    <x-form-builder-ui::item-list :items="$checkable['items']" />

    @isset($checkable['title'])
        <a href="{{ $checkable['link'] }}">Edit Task</a>
    @endisset
@endforeach

<h2>Now submit your answers</h2>
<ul>
    <li>
        <a href="{{ $links['action'] }}">Submit</a>
    </li>
    @if($can_save === true)
        <li>
            <a href="{{ $links['other'] }}">Save</a>
        </li>
    @endif
    <li>
        <a href="{{ $links['exit'] }}">Cancel and exit</a>
    </li>
</ul>
