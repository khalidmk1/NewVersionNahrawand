<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\VideoInterface;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\VideoUpdateRequest;
use App\Http\Requests\ContentVideoRequest;


class ContentVideoController extends Controller
{

    private $videoInterface;

    public function __construct(VideoInterface $videoInterface) {
        $this->videoInterface = $videoInterface;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
    
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContentVideoRequest $request) 
    {
        return $this->videoInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $content)
    {
        return $this->videoInterface->create($content);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(VideoUpdateRequest $request, string $id)
    {
        return $this->videoInterface->update($request , $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request , string $id)
    {
        return $this->videoInterface->destroy($request , $id);
    }
}
