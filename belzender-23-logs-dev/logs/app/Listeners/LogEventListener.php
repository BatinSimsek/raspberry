<?php
namespace App\Listeners;

use App\Events\NewLogEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Log;

class LogEventListener implements ShouldQueue
{
    use InteractsWithQueue;

    public function handle(NewLogEvent $event)
    {
        $logData = $event->logData;
        Log::info('New Log Record: ' . json_encode($logData));
    }
}

