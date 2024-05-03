<?php

// App\Events\NewLogEvent.php

namespace App\Events;

use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class NewLogEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $logData;

    public function __construct($logData)
    {
        $this->logData = $logData;
    }

    public function broadcastOn()
    {
        return 'notifications';
    }
}
