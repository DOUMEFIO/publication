@props(['active'])

@php
$classes = "dropdown-item px-3"

@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
