<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\QuizIntreface;
use App\Http\Requests\DestroyRequest;

class QuizController extends Controller
{

    private $QuizInterface;

    public function __construct(QuizIntreface $QuizInterface) {
        $this->QuizInterface = $QuizInterface;
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
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return $this->QuizInterface->create($id);
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
        return $this->QuizInterface->update($request , $id);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(DestroyRequest $request , string $id)
    {
        return $this->QuizInterface->destroy($request , $id);
    }

    public function delete(String $id){
        return $this->QuizInterface->delete($id);
    }
}
