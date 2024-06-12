<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CardImage extends Component
{

    public $imageUrl;
    public $itemId;

    /**
     * Create a new component instance.
     */
    public function __construct($imageUrl , $itemId) 
    {
        $this->imageUrl = $imageUrl;
        $this->itemId = $itemId;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.card-image');
    }
}
