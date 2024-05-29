<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class DeleteModal extends Component
{

    public $modelDeleteId;
    public $modelRouteDelete;
    /**
     * Create a new component instance.
     */
    public function __construct($modelDeleteId, $modelRouteDelete)
    {
        $this->modelDeleteId = $modelDeleteId;
        $this->modelRouteDelete = $modelRouteDelete;
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.delete-modal');
    }
}
