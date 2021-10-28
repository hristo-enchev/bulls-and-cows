<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">


    <title>
        @isset($title)
            {{ $title }} |
        @endisset
        {{ env('APP_NAME', 'Bulls & Cows') }}
    </title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.11.2/css/all.css" />

    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    @livewireStyles
</head>

<body class="flex flex-col min-h-screen font-mono bg-gray-400">
    @include('layouts.header')

    <main class="flex-grow">
        {{ $slot }}
    </main>

    @include('layouts.footer')

    <script src="{{ mix('js/app.js') }}"></script>
    @livewireScripts
</body>
</html>
