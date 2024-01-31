<?php

namespace Src\Models;

class Protocol extends Model
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
     * @return Time
     */
    public function time(): Time
    {
        return $this->belongsTo(Time::class, 'schedules', 'time_id');
    }

    /**
     * @since 1.7.0
     * 
     * @return Client
     */
    public function client(): Client
    {
        return $this->belongsTo(Client::class, 'clients', 'client_id');
    }
}
