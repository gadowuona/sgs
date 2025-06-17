<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link href="https://fonts.bunny.net/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    @vite(['resources/css/app.css', 'resources/js/app.js'])
</head>

<body class="antialiased">
    <div
        class="relative flex items-top justify-center min-h-screen bg-gray-100 dark:bg-gray-900 sm:items-center py-4 sm:pt-0">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>
                @endauth
            </div>
        @endif

        <div class="max-w-6xl mx-auto sm:px-6 lg:px-8">
            <div class="flex justify-center pt-8 sm:justify-start sm:pt-0">
                <!--  -->
                <a href="route('dashboard')" title="UCC SGS" class="flex items-center">
                    <img src="{{ asset('assets/logo.png') }}" alt="UCC"
                        style=" height: 100px; margin-bottom: 5px;">
                    <div id="site-slogan" class="text-gray-600 dark:text-[#EF3B2D] text-[2rem] font-semibold">UCC School
                        of Graduate
                        Studies <br>Supervisor
                        Thesis Management Portal</div>
                </a>
            </div>

            <div class="mt-8 bg-white dark:bg-gray-800 overflow-hidden shadow sm:rounded-lg">
                <div class="grid grid-cols-1 md:grid-cols-2">
                    <div class="p-6">
                        @if (Route::has('login'))
                            <div class="">
                                @auth
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none"
                                            viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                                            <path stroke-linecap="round" stroke-linejoin="round"
                                                d="M16 8v8m-4-5v5m-4-2v2m-2 4h12a2 2 0 002-2V6a2 2 0 00-2-2H6a2 2 0 00-2 2v12a2 2 0 002 2z" />
                                        </svg>
                                        <div class="ml-2 text-gray-600 dark:text-gray-400 text-xl leading-7 font-semibold">
                                            <a href="{{ url('/dashboard') }} "
                                                class="underline text-gray-600 !uppercase">Dashboard</a>
                                        </div>
                                    </div>
                                @else
                                    <div class="flex items-center">
                                        <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" viewBox="0 0 20 20"
                                            fill="currentColor">
                                            <path fill-rule="evenodd"
                                                d="M3 3a1 1 0 011 1v12a1 1 0 11-2 0V4a1 1 0 011-1zm7.707 3.293a1 1 0 010 1.414L9.414 9H17a1 1 0 110 2H9.414l1.293 1.293a1 1 0 01-1.414 1.414l-3-3a1 1 0 010-1.414l3-3a1 1 0 011.414 0z"
                                                clip-rule="evenodd" />
                                        </svg>
                                        <div class="ml-2 text-gray-600 dark:text-gray-400 text-xl leading-7 font-semibold">
                                            <a href="{{ route('login') }}" class="underline text-gray-900 !uppercase">Log
                                                in</a>
                                        </div>
                                    </div>
                                @endauth
                            </div>
                        @endif
                    </div>

                    <div class="p-6 border-t border-gray-200 dark:border-gray-700 md:border-t-0 md:border-l">

                    </div>

                </div>
            </div>
        </div>
    </div>
</body>

</html>
