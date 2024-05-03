<?php
namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;

class LogAddedNotification extends Notification
{
    use Queueable;

    protected $log;

    public function __construct($log)
    {
        $this->log = $log;
    }

    public function toWebPush($notifiable, $notification)
    {
        return (new WebPushMessage)
            ->title('Er wordt aangebeld!')
            ->body('Log ID: ' . $this->log->id);
    }
}
