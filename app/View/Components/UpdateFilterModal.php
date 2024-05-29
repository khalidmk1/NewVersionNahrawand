<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class UpdateFilterModal extends Component
{

    public $filterId;
    public $titleModel;
    public $modelRoute;
    /**
     * Create a new component instance.
     */
    public function __construct($filterId, $titleModel, $modelRoute)
    {
        $this->filterId = $filterId;
        $this->titleModel = $titleModel;
        $this->modelRoute = $modelRoute;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.update-filter-modal');
    }
}
