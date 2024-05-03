<?php

namespace App\Console\Commands;

use App\Events\NewLogAdded;
use App\Models\Log as LogModel;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Event;
use Illuminate\Support\Facades\Log;

class DatabaseLogCommand extends Command
{
    protected $signature = 'logs';

    protected $description = 'Check the database for new logs';

    public function handle()
    {
        LogModel::where('processed', 0)
            ->each(fn (LogModel $lm) => $this->processRow($lm));
    }

    private function processRow(
        LogModel $log
    ) {
        Log::info('New Log: ', $log->toArray());
        Event::dispatch(new NewLogAdded($log));
        $log->update(['processed' => 1]);
    }
}

