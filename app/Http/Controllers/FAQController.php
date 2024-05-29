<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\FAQInterface;
use App\Http\Requests\FAQRequest;

class FAQController extends Controller
{
    private $FAQInterface;

    public function __construct(FAQInterface $FAQInterface) {
        $this->FAQInterface = $FAQInterface;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  $this->FAQInterface->index();
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(FAQRequest $request)
    {
        return  $this->FAQInterface->store($request);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
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
    public function update(FAQRequest $request, string $id)
    {
        return  $this->FAQInterface->update($request , $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
