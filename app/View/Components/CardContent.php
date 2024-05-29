<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardContent extends Component
{

    public $videoUrl;
    public $videoID;

    /**
     * Create a new component instance.
     */
    public function __construct($videoUrl , $videoID)
    {
        $this->videoUrl = $videoUrl;
        $this->videoID = $videoID;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-content');
    }
}
