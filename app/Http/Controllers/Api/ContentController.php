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
    public function index()
    {
        return $this->contentInterface->indexApi(); 
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
