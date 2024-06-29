<?php

namespace App\Services\Notification;

use App\Interfaces\NotificationInterface;
use App\Services\Notification\NotificationQuery;

class NotificationService extends NotificationQuery implements NotificationInterface{


    public function index(){
        return view('notification.index');
    }

    public function allUserNotfication(){
        return $this->allNotification();
    }

    public function allSentNotification(){
        return $this->allNotificationSent();
    }

    public function update($notificationId){
        $this->markNotificationAsRead($notificationId);
        return redirect()->back();
    }

    public function destoy($notificationId){
        $this->deleteNotification($notificationId);
        return redirect()->back();
    }
}
