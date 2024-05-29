<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ContentInterface;
use App\Http\Requests\ContentRequest;
use App\Http\Requests\DestroyRequest;
use App\Http\Requests\ContentUpdateRequest;

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
        return  $this->contentInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return $this->contentInterface->create();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(ContentRequest $request)
    {
        return $this->contentInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $content)
    {
        return $this->contentInterface->show($content);
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
    public function update(ContentUpdateRequest $request, string $id)
    {
        return $this->contentInterface->update($request , $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request , string $id)
    {
        return $this->contentInterface->destroy($request , $id);
    }
}
