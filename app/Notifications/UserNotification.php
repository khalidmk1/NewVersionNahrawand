<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserNotification extends Notification
{
    use Queueable;

    protected $itemId;
    protected $itemTitle;
    protected $itemMessage;
    protected $itemType;

    /**
     * Create a new notification instance.
     */
    public function __construct($itemId, $itemTitle, $itemMessage , $itemType)
    {
        $this->itemId = $itemId;
        $this->itemTitle = $itemTitle;
        $this->itemMessage = $itemMessage;
        $this->itemType = $itemType;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     */
    /* public function toMail(object $notifiable): MailMessage
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }
 */
    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            'itemId' => Crypt::encrypt($this->itemId),
            'itemTitle' => $this->itemTitle,
            'itemMessage' => $this->itemMessage,
            'itemType' => $this->itemType
        ];
    }
}
