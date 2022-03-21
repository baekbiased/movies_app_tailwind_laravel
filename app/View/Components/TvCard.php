<?php

namespace App\View\Components;

use Illuminate\View\Component;

class TvCard extends Component
{
    public $tv;

    public function __construct($tv)
    {
        $this->tv = $tv;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.tv-card');
    }
}
