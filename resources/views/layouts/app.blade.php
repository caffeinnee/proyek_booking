<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }}</title>

        @vite(['resources/css/app.css', 'resources/js/app.js'])
    </head>
    <body class="font-sans antialiased">
        <div class="min-h-screen bg-gray-100 flex flex-col md:flex-row">
            
            <div class="md:sticky md:top-0 md:h-screen md:overflow-y-auto flex-shrink-0 z-20">
                @include('layouts.navigation')
            </div>

            <main class="flex-1 min-w-0 flex flex-col min-h-screen"> 
                
                @if (isset($header))
                    <header class="bg-white shadow sm:hidden">
                        <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                            {{ $header }}
                        </div>
                    </header>
                @endif

                <div class="py-6 flex-grow px-4 sm:px-6 lg:px-8"> 
                    {{ $slot }}
                </div>
                
                @include('layouts.footer') 
            </main>
            
        </div>
    </body>
</html>