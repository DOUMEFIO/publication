<!DOCTYPE html>
<html {{ $attributes->merge([
    'lang' => str_replace('_', '-', app()->getLocale())
]) }}>

    <x-head :title="$attributes->get('title', null)"/>

    {{ $slot }}
</html>
