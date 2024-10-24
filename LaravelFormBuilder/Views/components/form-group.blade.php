<fieldset>
    <legend>{{ $label }}</legend>

    @if($errors->has($name) === true)
        <ul>
            @foreach($errors->get("$name*") as $id => $messages)
                @foreach ($messages as $message)
                    <li>{{ $message }}</li>
                @endforeach
            @endforeach
        </ul>
    @endif

    {{ $slot }}
    
    @if($hint !== null)
        <p>{{ $hint }}</p>
    @endif
</fieldset>
