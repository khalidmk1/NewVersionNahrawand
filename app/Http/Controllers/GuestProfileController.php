<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\ProfileInterface;
use App\Http\Requests\ProfileUpdateRequest;

class GuestProfileController extends Controller
{
    private $ProfileInterface;

    public function __construct(ProfileInterface $ProfileInterface) {
        $this->ProfileInterface = $ProfileInterface;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* return $this->ProfileInterface->indexAdmin(); */
    }

  
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        /* return $this->ProfileInterface->create(); */
    }

   

    /**
     * Store a newly created resource in storage.
     */
    public function store(ProfileUpdateRequest $request)
    {
        return $this->ProfileInterface->store($request);
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
