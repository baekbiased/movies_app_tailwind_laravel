<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class MoviesViewModel extends ViewModel
{
    public $popularMovies;
    public $nowPlaying;
    public $genres;

    public function __construct($popularMovies, $nowPlaying, $genres)
    {
        $this->popularMovies = $popularMovies;
        $this->nowPlaying = $nowPlaying;
        $this->genres = $genres;
    }

    public function popularMovies(){
        return $this->formatMovies($this->popularMovies);
    }

    public function nowPlaying(){
        return $this->formatMovies($this->nowPlaying);
    }

    public function genres(){
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    private function formatMovies($movies){

        return collect($movies)->map(function($movie){

                $genresFormatted = collect($movie['genre_ids'])->mapWithKeys(function ($value){
                    return [$value => $this->genres()->get($value)];
                })->implode(', ');

            return collect($movie)->merge([
                'poster_path' => 'https://www.themoviedb.org/t/p/w220_and_h330_face/'.$movie['poster_path'],
                'vote_average' => $movie['vote_average'] * 10 . '%',
                'release_date' => Carbon::parse($movie['release_date'])->format('M, d, Y'),
                'genres' => $genresFormatted,
            ]);
        });
    }




}
