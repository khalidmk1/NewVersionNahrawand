<?php

namespace App\Livewire;

use App\Models\Content;
use Livewire\Component;
use Livewire\WithPagination;

class QuicklyCard extends Component
{
    use WithPagination;
    
    public function render()
    {
        $contentQuickly = Content::where('contentType', 'quickly')->paginate(9);
        return view('livewire.quickly-card')->with('contentQuickly' , $contentQuickly);
    }
}
