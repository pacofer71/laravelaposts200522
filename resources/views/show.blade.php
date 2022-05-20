<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Laravel</title>

    <!-- Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">

    <!-- Styles -->
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <style>
        body {
            font-family: 'Nunito', sans-serif;
        }

    </style>
</head>

<body class="antialiased">
    <div class="flex items-top justify-center bg-gray-200 dark:bg-gray-900 sm:items-center py-4 sm:pt-0 mb-4">
        @if (Route::has('login'))
            <div class="hidden fixed top-0 right-0 px-6 py-4 sm:block">
                @auth
                    <a href="{{ url('/dashboard') }}"
                        class="text-sm text-gray-700 dark:text-gray-500 underline">Dashboard</a>
                @else
                    <a href="{{ route('login') }}" class="text-sm text-gray-700 dark:text-gray-500 underline">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}"
                            class="ml-4 text-sm text-gray-700 dark:text-gray-500 underline">Register</a>
                    @endif
                @endauth
            </div>
        @endif


    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

        <div class="flex bg-white dark:bg-gray-800 rounded-lg shadow">
            <div class="flex-none w-32 md:w-48  relative">
                <img src="{{ Storage::url($post->image->url) }}" alt="{{ $post->titulo }}"
                    class="absolute rounded-lg inset-0 w-full h-full object-cover object-center" />
            </div>
            <div class="flex-auto p-6">
                <div class="flex flex-wrap px-2 py-2 rounded-lg border">
                    <h1 class="flex-auto text-xl font-semibold dark:text-gray-50">
                        {{ $post->titulo }}
                    </h1>
                    <div class="text-xl font-semibold text-teal-500 dark:text-teal-300">
                        Categoría: {{ $post->category->nombre }}
                    </div>
                    <div class="w-full flex-none text-sm font-medium text-gray-500 dark:text-gray-300 mt-2">
                        {{ $post->contenido }}
                    </div>
                </div>
                <div class="px-2 py-4 rounded-lg border mt-4">
                    <p class="text-xl text-gray-600 dark:text-gray-300">Tags #</p>
                    <div class="flex items-baseline mt-2 mb-6 text-gray-700 dark:text-gray-300">

                        <div class="space-x-2 flex">
                            @foreach ($post->tags as $item)
                                <label class="text-center text-purple-600 dark:text-purple-300">
                                    #{{ $item->nombre }}
                                </label>
                            @endforeach

                        </div>

                    </div>
                </div>
                <div class="mt-4 rounded-lg border px-2 py-4">
                    <div
                        class="w-1/2 grid grid-cols-2 gap-2 text-gray-600 dark:text-gray-300 justify-items-start content-start">
                        <div class="w-24 font-bold">
                            Autor :
                        </div>
                        <div style="font-weight: 100">
                            {{ $post->user->email }}
                        </div>
                        <div class="font-bold w-24">
                            Publicado :

                        </div>
                        <div class="font-thin">
                            {{ $post->created_at->format('d/m/Y h:m:s a') }}
                        </div>
                    </div>
                </div>
                <div class="flex mb-4 text-sm font-medium mt-4">
                    <a href="/"
                        class="py-2 px-4  bg-indigo-600 hover:bg-indigo-700 focus:ring-indigo-500 focus:ring-offset-indigo-200 text-white w-full transition ease-in duration-200 text-center text-base font-semibold shadow-md focus:outline-none focus:ring-2 focus:ring-offset-2  rounded-lg ">
                        Volver
                </a>
                </div>

            </div>
        </div>


    </div>
</body>

</html>
