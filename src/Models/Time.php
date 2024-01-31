<?php

namespace Src\Models;

class Time extends Model
{
    public $table = 'schedules';

    /**
     * @since 1.7.0
     * 
     * @return Event
     */
    public function event(): Event
    {
        return $this->belongsTo(Event::class, 'events', 'event_id');
    }

    /**
     * @since 1.7.0
     * 
     * @return Protocol
     */
    public function protocols(): Protocol
    {
        return $this->hasMany(Protocol::class, 'protocols', 'time_id');
    }
}
