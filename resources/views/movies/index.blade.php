@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4">
        <div class="popular-movies border-b border-gray-800 py-16">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Movies</h2>
            <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-16">

                @foreach($popularMovies as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach

            </div>
        </div>

        <div class="now-playing border-b border-gray-800 py-16 mb-16">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Now Playing</h2>
            <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-16">

                @foreach($nowPlaying as $movie)
                    <x-movie-card :movie="$movie" />
                @endforeach

            </div>
        </div>
    </div>

@endsection

