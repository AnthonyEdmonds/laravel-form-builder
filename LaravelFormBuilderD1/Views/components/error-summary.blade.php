@isset($errors)
    @if($errors->any() === true)
        <div>
            <h2>{{ $title }}</h2>
        
            <ul>
                @foreach($errors->getMessages() as $id => $errors)
                    @foreach($errors as $error)
                        <li>
                            <a href="#{{ $id }}">{{ $error }}</a>
                        </li>
                    @endforeach
                @endforeach
            </ul>
        </div>
    @endif
@endisset
