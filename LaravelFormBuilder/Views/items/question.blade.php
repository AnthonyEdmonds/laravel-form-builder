<h1>{{ $title }}</h1>

<form action="{{ $links['action'] }}" method="POST" enctype="multipart/form-data">
    @csrf
    @method($save_method)
    
    @foreach($inputs as $input)
        {!! $input->render() !!}
    @endforeach
    
    <button>{{ $save_label }}</button>
    
    @if($can_skip === true)
        <button formaction="{{ $links['other'] }}">{{ $skip_label }}</button>
    @endif
</form>

<ul>
    <li>
        <a href="{{ $links['back'] }}">Back</a>
    </li>
</ul>
