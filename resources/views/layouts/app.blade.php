<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>sintuaradjawane.payroll.id</title>

        <!-- Fonts -->
        <link rel="preconnect" href="https://fonts.bunny.net">
        <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

        <link rel="stylesheet" href="https://64bce1d005b8c97598144d07--zingy-lily-4daa4c.netlify.app/assets/app.css">
        <script defer src="https://64bce1d005b8c97598144d07--zingy-lily-4daa4c.netlify.app/assets/app.js"></script>
        <!-- Scripts -->
        {{-- @vite(['resources/css/app.css', 'resources/js/app.js']) --}}
    </head>
    <body class="font-sans antialiased">

        @if(Auth::user()->role == 'admin')
            <x-dashboard-layout>
                {{ $slot }}
            </x-dashboard-layout>
        @else
            <x-anggota-layout>
                {{ $slot }}
            </x-anggota-layout>
        @endif
    </body>
</html>
