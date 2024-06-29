<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Interfaces\NotificationInterface;

class NotificationController extends Controller
{

    private $notificationInterface;

    public function __construct(NotificationInterface $notificationInterface) {
        $this->notificationInterface = $notificationInterface;
    }


    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return  $this->notificationInterface->index();
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
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(string $notificationId)
    {
        return  $this->notificationInterface->update($notificationId);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $notificationId)
    {
        return  $this->notificationInterface->destoy($notificationId);
    }
}
