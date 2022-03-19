@extends('layouts.main')

@section('content')
    <div class="container mx-auto px-4 py-16">
        <div class="popular-actors border-b border-gray-800 py-16">
            <h2 class="uppercase tracking-wider text-orange-500 text-lg font-semibold">Popular Actors</h2>
            <div class="grid sm:grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-16">
                @foreach($popularActors as $actor)
                    <div class="actors mt-8">
                        <a href="#">
                            <img src="{{ $actor['profile_path'] }}" alt="actor">
                        </a>
                        <div class="mt-2">
                            <a href="#" class="text-lg hover:text-gray-300">{{ $actor['name'] }}</a>
                            <div class="text-sm truncate text-gray-400">{{ $actor['known_for'] }}</div>
                        </div>
                    </div>
                @endforeach

            </div>
        </div>
    </div>

@endsection

