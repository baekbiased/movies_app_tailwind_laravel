<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;
use Illuminate\Support\Carbon;

class TvViewModel extends ViewModel
{
    public $popularTv;
    public $topRated;
    public $genres;

    public function __construct($popularTv, $topRated, $genres)
    {
        $this->popularTv = $popularTv;
        $this->topRated = $topRated;
        $this->genres = $genres;
    }

    public function popularTv(){
        return $this->format_shows($this->popularTv);
    }

    public function topRated(){
        return $this->format_shows($this->topRated);
    }

    public function genres(){
        return collect($this->genres)->mapWithKeys(function ($genre){
            return [$genre['id'] => $genre['name']];
        });
    }

    private function format_shows($shows){
        return collect($shows)->map(function ($show){

            $genresFormatted = collect($show['genre_ids'])->mapWithKeys(function ($value){
                return [$value => $this->genres()->get($value)];
            })->implode(', ');

            return collect($show)->merge([
                'poster_path' => $show['poster_path']
                    ? 'https://www.themoviedb.org/t/p/w220_and_h330_face'.$show['poster_path']
                    : 'https://via.placeholder.com/220x330',
                'first_air_date' => Carbon::parse($show['first_air_date'])->format('M, d, Y'),
                'vote_average' => $show['vote_average'] * 10 . '%',
                'genres' => $genresFormatted,
            ]);
        });
    }
}
