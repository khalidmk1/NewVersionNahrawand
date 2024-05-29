<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CreateFilterModal extends Component
{

    public $modelRouteCreate;
    public $titleModel;
    /**
     * Create a new component instance.
     */
    public function __construct( $modelRouteCreate , $titleModel)
    {
        $this->modelRouteCreate = $modelRouteCreate;
        $this->titleModel = $titleModel;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.create-filter-modal');
    }
}
