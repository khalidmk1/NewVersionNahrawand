<?php

namespace  App\Interfaces;

interface NotificationInterface {
    public function index();
    public function allSentNotification();
    public function allUserNotfication();
    
    //notification
    public function update($notificationId);
    public function destoy($notificationId);
}