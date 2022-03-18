<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class MovieViewModel extends ViewModel
{
    public $movie;

    public function __construct($movie)
    {
        $this->movie = $movie;
    }

    public function movie(){

        return collect($this->movie)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/'.$this->movie['poster_path'],
            'vote_average' => $this->movie['vote_average'] * 10 . '%',
            'release_date' => Carbon::parse($this->movie['release_date'])->format('M, d, Y'),
            'genres' => collect($this->movie['genres'])->pluck('name')->implode(', '),
            'crew' => collect($this->movie['credits']['crew'])->take(4),
            'cast' => collect($this->movie['credits']['cast'])->take(5),
            'backdrops' => collect($this->movie['images']['backdrops'])->take(6),
        ]);
    }
}
