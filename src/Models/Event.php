<?php

namespace Src\Models;

class Event extends Model
{
    public $table = 'events';

    /**
     * @since 1.7.0
     * 
     * @return Client
     */
    public function client(): Client
    {
        return $this->belongsTo(Client::class, 'clients', 'client_id');
    }

    /**
     * @since 1.7.0
     * 
     * @return Location
     */
    public function location(): Location
    {
        return $this->belongsTo(Location::class, 'locations', 'location_id');
    }

    /**
     * @since 1.7.0
     * 
     * @return Schedule
     */
    public function schedules(): Schedule
    {
        return $this->hasMany(Schedule::class, 'schedules', 'event_id');
    }
}
