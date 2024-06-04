<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\ContentInterface;

class ContentController extends Controller
{
    private $contentInterface;

    public function __construct(ContentInterface $contentInterface) {
        $this->contentInterface = $contentInterface;
    }

    
    /**
     * Display a listing of the resource.
     */
    public function allContent()
    {
        return $this->contentInterface->allContent(); 
    }

    public function comingSoonContent(){
        return $this->contentInterface->comingSoonContent();
    }

    public function contentFormation(){
        return $this->contentInterface->contentFormation();
    }
}
