<?php
namespace App\Listeners;

use App\Events\NewLogAdded;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Notification;
use App\Notifications\LogAddedNotification;

class SendLogNotification implements ShouldQueue
{
    public function handle(NewLogAdded $event)
    {
        $logModel = $event->log;
        $logModel->notify(new LogAddedNotification($event->log));
    }
}
