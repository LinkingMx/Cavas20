<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="shortcat icon" href="images/favicon.ico"> 


    <!-- Scripts -->
    @livewireScripts
    <wireui:scripts />
    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <!-- Styles -->
    @livewireStyles
</head>

<body class="font-sans antialiased">

    <!-- nav component -->
    <x-custom.nav />

    <!-- notify -->
    <x-notifications />

    <!-- aside bar component-->
    <x-custom.aside />


    <div class="p-4 sm:ml-64">
        <div class="p-4 rounded-lg dark:border-gray-700 mt-14">
            <x-card>
                {{ $slot }}
            </x-card>
        </div>
    </div>

    @stack('modals')


</body>

</html>
