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
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-2">
            @foreach ($posts as $item)
                <a href="{{route('posts.show', $item)}}" class="cursor-pointer w-full h-80 bg-cover bg-center @if ($loop->first) md:col-span-2 @endif"
                    style="background-image:url({{ Storage::url($item->image->url) }})">
                    <div class="flex flex-col justify-center w-full h-full">
                        <div class="font-bold text-white ml-2 mb-2 text-lg">
                            {{ $item->titulo }}
                        </div>
                        <div class="mt-1 flex justify-between px-2">
                            @foreach($item->tags as $tag)
                            <p class="text-gray-200 font-bold">#{{$tag->nombre}}</p>
                            @endforeach
                        </div>
                        <div class="ml-2 italic text-gray-200">
                            ({{ $item->user->email }})
                        </div>
                    </div>
                </a>
            @endforeach

        </div>
        <div class="mt-2">
            {{$posts->links()}}
        </div>
    </div>
</body>

</html>
