<h1>Task label</h1>

<x-form-builder-ui::item-list :items="$check" />

<ul>
    <li>
        <a href="{{ $links['next'] }}">Next</a>
    </li>
    <li>
        <a href="{{ $links['back'] }}">Back</a>
    </li>
</ul>
