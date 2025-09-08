<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Thesis Schedule - {{ config('app.name', 'Laravel') }}</title>
    @vite(['resources/css/app.css', 'resources/js/app.js'])
        <link rel="icon" href="{{ asset('images/logouin.png') }}" type="image/png">

</head>
<body class="bg-gray-100 font-sans leading-normal tracking-normal">

    <x-navbar />

    <main>
        <div class="container mx-auto max-w-4xl py-12 px-4 sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-6 sm:p-8">
                <h1 class="text-2xl sm:text-3xl font-bold text-gray-800 border-b-2 border-red-600 pb-3 mb-6">
                    Thesis Schedule
                </h1>

                <div class="prose max-w-none">
                    @if($schedules->isNotEmpty())
                        <ol class="list-decimal list-inside space-y-3">
                            @foreach($schedules as $schedule)
                                <li>
                                    <a href="{{ $schedule->url }}" target="_blank" rel="noopener noreferrer" class="text-blue-600 hover:text-blue-800 hover:underline transition-colors duration-200">
                                        {{ $schedule->title }}
                                    </a>
                                </li>
                            @endforeach
                        </ol>
                    @else
                        <p class="text-gray-600">The thesis schedule is not yet available. Please check back later.</p>
                    @endif
                </div>
            </div>
        </div>
    </main>

    <x-footer />

</body>
</html>