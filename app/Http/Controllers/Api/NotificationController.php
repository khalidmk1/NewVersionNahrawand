<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Interfaces\NotificationInterface;

class NotificationController extends Controller
{

    private $notificationInterface;

    public function __construct(NotificationInterface $notificationInterface) {
        $this->notificationInterface = $notificationInterface;
    }
    
    public function index(){
        return  $this->notificationInterface->allSentNotification();
    }
}
