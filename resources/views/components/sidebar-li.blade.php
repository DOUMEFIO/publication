@props([
    'icon',
    'href',
])
<li class="active"><a href="{{$href}}"><i class="{{$icon}}"></i><span class="menu-title" data-i18n="">{{ $slot }}</span></a>
</li>
