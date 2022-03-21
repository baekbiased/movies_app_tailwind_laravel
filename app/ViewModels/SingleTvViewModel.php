<?php

namespace App\ViewModels;

use Illuminate\Support\Carbon;
use Spatie\ViewModels\ViewModel;

class SingleTvViewModel extends ViewModel
{
    public $tv;

    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    public function tv(){
        return collect($this->tv)->merge([
            'poster_path' => 'https://image.tmdb.org/t/p/w600_and_h900_bestv2/'.$this->tv['poster_path'],
            'vote_average' => $this->tv['vote_average'] * 10 . '%',
            'first_air_date' => Carbon::parse($this->tv['first_air_date'])->format('M, d, Y'),
            'genres' => collect($this->tv['genres'])->pluck('name')->implode(', '),
            'crew' => collect($this->tv['credits']['crew'])->take(4),
            'cast' => collect($this->tv['credits']['cast'])->take(5),
            'backdrops' => collect($this->tv['images']['backdrops'])->take(6),
        ]);
    }
}
