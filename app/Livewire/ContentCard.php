<?php

namespace App\Livewire;

use App\Models\Content;
use Livewire\Component;
use Livewire\WithPagination;

class ContentCard extends Component
{
    use WithPagination;
    
    
    public function render()
    {
        $contentType = ['conference', 'podcast', 'formation'];
        $contents = Content::orderBy('created_at', 'desc')
        ->whereIn('contentType', $contentType)->paginate(9);
        return view('livewire.content-card', compact('contents'));
    }
}
