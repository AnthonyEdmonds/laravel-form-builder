<?php

namespace AnthonyEdmonds\LaravelFormBuilder\Enums;

enum InputType: string
{
    case Button = 'button';

    case Checkbox = 'checkbox';

    case Colour = 'color';

    case Date = 'date';

    case DateTimeLocal = 'datetime-local';

    case Email = 'email';

    case File = 'file';

    case Hidden = 'hidden';

    case Image = 'image';

    case Month = 'month';

    case Number = 'number';

    case Password = 'password';

    case Radio = 'radio';

    case Range = 'range';

    case Reset = 'reset';

    case Search = 'search';

    case Select = 'select';

    case Submit = 'submit';

    case Tel = 'tel';

    case Text = 'text';

    case TextArea = 'textarea';

    case Time = 'time';

    case Url = 'url';

    case Week = 'week';
}
