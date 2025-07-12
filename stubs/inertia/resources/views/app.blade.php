<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}" class="{{ app()->dark_theme }}"
      dir="{{ in_array(str_replace('_', '-', app()->getLocale()), config('jetstream.rtl_locales')) ? 'rtl' : 'ltr' }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>
        <link rel="icon" href="{{ asset('favicon.png') }}" type="image/x-icon" />

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <!-- Scripts -->
        @routes
        @vite(['resources/js/app.js', "resources/js/Pages/{$page['component']}.vue"])
        @inertiaHead
    </head>
    <body class="bg-gray-100 dark:bg-gray-900 font-sans antialiased {{ in_array(str_replace('_', '-', app()->getLocale()), config('jetstream.rtl_locales')) ? "rtl" : "" }}">
        @inertia
    </body>
</html>
