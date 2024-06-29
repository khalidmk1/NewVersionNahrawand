<?php

namespace App\Services\Notification;

use App\Services\GlobaleService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Crypt;

class NotificationQuery extends GlobaleService{

    public function allNotification(){
        $user = Auth::user();
        $notifications = $user->notifications;
        $outputNotification = '';
        $outputNotification = view('notification.partial.notificationCard')->with('notifications' , $notifications)->render();
        return response()->json($outputNotification);
    }

    public function allNotificationSent(){
        $user = Auth::user(); 
        return response()->json($user->unreadNotifications);
    }

    public function markNotificationAsRead(String $notificationId)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail(Crypt::decrypt($notificationId));
        $notification->markAsRead();
        return $notification;
    }


    public function deleteNotification(String $notificationId)
    {
        $user = Auth::user();
        $notification = $user->notifications()->findOrFail(Crypt::decrypt($notificationId));
        $notification->delete();
        return $notification;
    }

}