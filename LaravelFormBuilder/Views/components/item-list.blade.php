<ul>
    @foreach($items as $item)
        <li>
            <b>{{ $item['label'] }}</b>:
            {{ $item['value'] }}
            @if($showEdit === true && isset($item['link']) === true)
                (<a href="{{ $item['link'] }}">Edit</a>)
            @endif
        </li>
    @endforeach
</ul>
