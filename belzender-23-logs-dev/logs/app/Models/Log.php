<?php

namespace App\Models;

use App\Events\NewLogEvent;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;

class Log extends Model
{
    use HasFactory, Notifiable;
    protected $fillable = ['description'];

    protected $dispatchesEvents = [
        'created' => NewLogEvent::class,
    ];
}
