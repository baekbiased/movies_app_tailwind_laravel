<?php

namespace App\ViewModels;

use Spatie\ViewModels\ViewModel;

class ActorsViewModel extends ViewModel
{
    public $popularActors;

    public function __construct($popularActors)
    {
        $this->popularActors = $popularActors;
    }

    public function popularActors(){
        return collect($this->popularActors)->map(function($actor) {
            return collect($actor)->merge([
                'profile_path' => $actor['profile_path']
                    ? 'https://www.themoviedb.org/t/p/w235_and_h235_face/'.$actor['profile_path']
                    : 'https://ui-avatars.com/api/?size=235&name='.$actor['profile_path'],
                'known_for' => collect($actor['known_for'])
                    ->where('media_type', 'movie')
                    ->pluck('title')
                    ->union(
                        collect($actor['known_for'])
                            ->where('media_type', 'tv')
                            ->pluck('name')
                    )->implode(', ')
            ])->only([
                'name', 'id', 'profile_path', 'known_for'
            ])->dump();
        });
    }
}
